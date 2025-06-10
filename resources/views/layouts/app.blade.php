    <!-- Javascript -->
    <script src="{{asset('assets/plugins/popper.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/plugins/chart.js/chart.min.js')}}"></script>
    <script src="{{asset('assets/js/index-charts.js')}}"></script>
    <script src="{{asset('assets/js/app.js')}}"></script>

    @stack('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search');
            if (searchInput) {
                let typingTimer;
                const doneTypingInterval = 500; // Délai en ms

                searchInput.addEventListener('keyup', function() {
                    clearTimeout(typingTimer);
                    typingTimer = setTimeout(performSearch, doneTypingInterval);
                });

                function performSearch() {
                    const searchTerm = searchInput.value;

                    fetch(`{{ route('medecin') }}?search=${searchTerm}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        updateMedicamentsList(data.medicaments);
                    })
                    .catch(error => console.error('Error:', error));
                }

                function updateMedicamentsList(medicaments) {
                    const tbody = document.getElementById('medicaments-table-body');
                    if (tbody) {
                        tbody.innerHTML = '';

                        medicaments.forEach(medicament => {
                            const tr = document.createElement('tr');
                            tr.innerHTML = `
                                <td class="cell">${medicament.nom}</td>
                                <td class="cell">${medicament.description}</td>
                                <td class="cell">${medicament.prix} FCFA</td>
                                <td class="cell">${medicament.categorie}</td>
                            `;
                            tbody.appendChild(tr);
                        });
                    }
                }
            }
        });
    </script>
</body>
</html>

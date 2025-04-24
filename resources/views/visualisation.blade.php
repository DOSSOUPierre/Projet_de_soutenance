<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualisation</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
</head>
<body class="bg-light py-4">
<div class="container">
    <h1 class="text-center mb-4">Visualisation des Recettes et Dépenses</h1>

    <div class="mb-4 text-start">
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">⬅ Retour au Dashboard</a>
    </div>
    @if (session('erreur'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
        {{ session('erreur') }}
    </div>
@endif


    @if($errors->any())
        <div class="alert alert-danger text-center">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="GET" action="{{ route('visualisation') }}" class="row g-3 mb-4 align-items-end">
        <div class="col-md-3">
            <label for="periode" class="form-label">Période</label>
            <select name="periode" id="periode" class="form-select">
                <option value="">-- Choisir la période --</option>
                <option value="jour" {{ request('periode') == 'jour' ? 'selected' : '' }}>Par jour</option>
                <option value="semaine" {{ request('periode') == 'semaine' ? 'selected' : '' }}>Par semaine</option>
                <option value="mois" {{ request('periode') == 'mois' ? 'selected' : '' }}>Par mois</option>
                <option value="annee" {{ request('periode') == 'annee' ? 'selected' : '' }}>Par année</option>
            </select>
        </div>
        <div class="col-md-3">
            <label for="date_debut" class="form-label">Date de début</label>
            <input type="date" name="date_debut" id="date_debut" class="form-control" value="{{ request('date_debut') }}">
        </div>
        <div class="col-md-3">
            <label for="date_fin" class="form-label">Date de fin</label>
            <input type="date" name="date_fin" id="date_fin" class="form-control" value="{{ request('date_fin') }}">
        </div>
        <div class="col-md-3 d-flex gap-2">
            <button type="submit" class="btn btn-primary w-100">Appliquer</button>
            <a href="{{ route('visualisation') }}" class="btn btn-outline-secondary w-100">Réinitialiser</a>
        </div>
    </form>

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Données des Recettes et Dépenses</h5>
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="tableDonnees">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Recettes (FCFA)</th>
                            <th>Dépenses (FCFA)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($labels))
                        @foreach($labels as $index => $label)
                            <tr>
                                <td>{{ $label }}</td>
                                <td>{{ number_format($recettesData[$index] ?? 0, 2) }}</td>
                                <td>{{ number_format($depensesData[$index] ?? 0, 2) }}</td>
                            </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if($aucune_donnee)
        <div class="alert alert-warning text-center">
            Aucune donnée trouvée pour la période sélectionnée.
        </div>
        <div class="text-center">
            <img src="{{ asset('images/no-data.svg') }}" alt="Aucune donnée" style="max-width: 200px;">
        </div>
    @else
    <div class="card mb-4">
        <div class="card-body">
            <canvas id="myChart"></canvas>
            <div class="mt-3 text-end">
                <button class="btn btn-success" onclick="exportGraph()">📥 Exporter le graphique PDF</button>
                <button class="btn btn-info mt-2" onclick="exportExcel()">📥 Exporter en Excel</button>
                <button class="btn btn-danger mt-2" onclick="exportTablePDF()">📄 Exporter le tableau PDF</button>
            </div>
        </div>
    </div>
    @endif

    <div class="row">
        <div class="col-md-4">
            <div class="alert alert-info">
                <h5>Performance</h5>
                <p>Total Recettes : {{ number_format($totalRecettes ?? 0, 2) }} FCFA</p>
                <p>Total Dépenses : {{ number_format($totalDepenses ?? 0, 2) }} FCFA</p>
                <strong>{{ $performance ?? 'Aucune performance calculée' }}</strong>
            </div>
        </div>
        <div class="col-md-4">
            <div class="alert alert-success">
                <h5>Rapport Financier</h5>
                <p>{{ $rapport ?? 'Aucun rapport disponible' }}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="alert alert-warning">
                <h5>Budget Prévisionnel</h5>
                <p>Recettes Estimées : {{ number_format($budgetPrevisionnel['recettes'] ?? 0, 2) }} FCFA</p>
                <p>Dépenses Estimées : {{ number_format($budgetPrevisionnel['depenses'] ?? 0, 2) }} FCFA</p>
                <p>Solde Estimé : {{ number_format($budgetPrevisionnel['solde'] ?? 0, 2) }} FCFA</p>
            </div>
        </div>
    </div>
</div>

<script>
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($labels ?? []),
            datasets: [
                {
                    label: 'Recettes',
                    data: @json($recettesData ?? []),
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderWidth: 2
                },
                {
                    label: 'Dépenses',
                    data: @json($depensesData ?? []),
                    borderColor: 'rgba(255, 99, 132, 1)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderWidth: 2
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': ' + context.formattedValue + ' FCFA';
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value + ' FCFA';
                        }
                    }
                }
            }
        }
    });

    function exportGraph() {
        const canvas = document.getElementById('myChart');
        const imageData = canvas.toDataURL('image/png');
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();
        doc.addImage(imageData, 'PNG', 10, 10, 190, 100);
        doc.save('graphique.pdf');
    }

    function exportExcel() {
        const data = [['Date', 'Recettes (FCFA)', 'Dépenses (FCFA)']];
        @foreach($labels as $index => $label)
            data.push(['{{ $label }}', '{{ number_format($recettesData[$index] ?? 0, 2) }}', '{{ number_format($depensesData[$index] ?? 0, 2) }}']);
        @endforeach

        const wb = XLSX.utils.book_new();
        const ws = XLSX.utils.aoa_to_sheet(data);
        XLSX.utils.book_append_sheet(wb, ws, 'Données');
        XLSX.writeFile(wb, 'donnees_recettes_depenses.xlsx');
    }

    function exportTablePDF() {
        html2canvas(document.querySelector('#tableDonnees')).then(canvas => {
            const { jsPDF } = window.jspdf;
            const pdf = new jsPDF();
            const imgData = canvas.toDataURL('image/png');
            pdf.addImage(imgData, 'PNG', 10, 10, 190, 0);
            pdf.save('tableau_donnees.pdf');
        });
    }
</script>
</body>
</html>

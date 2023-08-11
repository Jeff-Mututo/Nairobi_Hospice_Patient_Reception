<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nairobi Hospice | KPI Dashboard</title>

    <!-- Scripts -->
    @vite('resources/css/kpidash.css')
</head>
<body>

    <div class="navigationBar">
        <div class="userNavName">Welcome, <b>{{ Auth::user()->name }}</b></div>
        <div class="navHeader">Nairobi Hospice KPI Dashboard</div>
        <div class="navLinks">
            <a href="{{ URL('/admin') }}" class="navlinkitem">Admin</a>
            <a href="{{ URL('/profile') }}" class="navlinkitem">Profile</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" id="logoutBtn">Log Out</button>
            </form>
        </div>
    </div>

    <div class="errorMessage">
    </div>

    <div class="statsSection">
        <div class="statCard">
            <p class="statQualifier">Average</p>
            <p class="statHeader">Employee Satisfaction</p>
            <hr class="statDivider">
            <p class="statValue">{{ $avgEmpSat }}/10</p>
        </div>
        <div class="statCard">
            <p class="statQualifier">Average</p>
            <p class="statHeader">Patient Satisfaction</p>
            <hr class="statDivider">
            <p class="statValue">{{ $avgPatSat }}/10</p>
        </div>
        <div class="statCard">
            <p class="statQualifier">Average</p>
            <p class="statHeader">Time With Patients</p>
            <hr class="statDivider">
            <p class="statValue">{{ $avgTimeWPatients }} min</p>
        </div>
        <div class="statCard">
            <p class="statQualifier">Average(Monthly)</p>
            <p class="statHeader">General/Admin Expenses</p>
            <hr class="statDivider">
            <p class="statValue">KSH. {{ $avgGAExpenses }}</p>
        </div>
    </div>

    <div class="chartContainer">
        <!-- KPI 1a -->
        <div class="chartCard">
            <div class="chartCardTitleRow">
                <p id="kpiTitle">KPI1a (leading): Employee understanding of digitised administration system</p>
                <p id="kpiTarget">Target: 8/10 Average Employee Understanding</p>
            </div>
            <hr class="chartDivider">
            <div class="chartCanvas">
                <canvas class="kpiCanvas" id="kpi1a"></canvas>
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    const ctx = document.getElementById('kpi1a');
                    var dataArray= {{ Js::from($kpiOneAData) }};

                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                        labels: ['2018', '2019', '2020', '2021', '2022'],
                        datasets: [{
                            label: 'Avg Understanding Score',
                            data: dataArray,
                            borderWidth: 1,
                            backgroundColor: [
                                'rgb(204, 201, 161)',
                                'rgb(94, 105, 115)',
                                'rgb(165, 63, 43)',
                                'rgb(76, 35, 10)',
                                'rgb(40, 0, 4)'
                            ]
                        }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                </script>
            </div>
        </div>

        <!-- KPI 1b -->
        <div class="chartCard">
            <div class="chartCardTitleRow">
                <p id="kpiTitle">KPI1b (lagging): Employee Satisfaction With Work</p>
                <p id="kpiTarget">Target: 7/10 Average Employee Satisfaction</p>
            </div>
            <hr class="chartDivider">
            <div class="chartCanvas">
                <canvas class="kpiCanvas" id="kpi1b"></canvas>
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    const ctx1b = document.getElementById('kpi1b');
                    var dataArray1b = {{ Js::from($kpiOneBData) }};

                    new Chart(ctx1b, {
                        type: 'bar',
                        data: {
                        labels: ['2018', '2019', '2020', '2021', '2022'],
                        datasets: [{
                            label: 'Avg Satisfaction Score',
                            data: dataArray1b,
                            borderWidth: 1,
                            backgroundColor: [
                                'rgb(204, 201, 161)',
                                'rgb(94, 105, 115)',
                                'rgb(165, 63, 43)',
                                'rgb(76, 35, 10)',
                                'rgb(40, 0, 4)'
                            ]
                        }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                </script>
            </div>
        </div>

        <!-- KPI 2a -->
        <div class="chartCard">
            <div class="chartCardTitleRow">
                <p id="kpiTitle">KPI2a (leading): Time spent with patients</p>
                <p id="kpiTarget">Target: 10% increase in overall time spent with patients</p>
            </div>
            <hr class="chartDivider">
            <div class="chartCanvas">
                <canvas class="kpiCanvas" id="kpi2a"></canvas>
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    const ctx2a = document.getElementById('kpi2a');
                    var dataArray2a = {{ Js::from($kpiTwoAData[0]) }};
                    var colorArray2a = {{ Js::from($kpiTwoAData[1]) }};

                    new Chart(ctx2a, {
                        type: 'bar',
                        data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                        datasets: [{
                            label: '% Change In Time Spent With Patients',
                            data: dataArray2a,
                            borderWidth: 1,
                            backgroundColor: colorArray2a
                        }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                </script>
            </div>
        </div>

        <!-- KPI 2b -->
        <div class="chartCard">
            <div class="chartCardTitleRow">
                <p id="kpiTitle">KPI2b (lagging): Administrative error rate</p>
                <p id="kpiTarget">Target: 5% decrease in the administrative error rate</p>
            </div>
            <hr class="chartDivider">
            <div class="chartCanvas">
                <canvas class="kpiCanvas"></canvas>
            </div>
        </div>

        <!-- KPI 3a -->
        <div class="chartCard">
            <div class="chartCardTitleRow">
                <p id="kpiTitle">KPI3a (leading): Time spent with patients</p>
                <p id="kpiTarget">Target: 10% increase in overall time spent with patients</p>
            </div>
            <hr class="chartDivider">
            <div class="chartCanvas">
                <canvas class="kpiCanvas" id="kpi3a"></canvas>
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    const ctx3a = document.getElementById('kpi3a');
                    var dataArray3a = {{ Js::from($kpiThreeAData[0]) }};
                    var colorArray3a = {{ Js::from($kpiThreeAData[1]) }};

                    new Chart(ctx3a, {
                        type: 'bar',
                        data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                        datasets: [{
                            label: '% Change In Time Spent With Patients',
                            data: dataArray3a,
                            borderWidth: 1,
                            backgroundColor: colorArray3a
                        }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                </script>
            </div>
        </div>

        <!-- KPI 3b -->
        <div class="chartCard">
            <div class="chartCardTitleRow">
                <p id="kpiTitle">KPI3b (lagging): Patient satisfaction with care</p>
                <p id="kpiTarget">Target for the Avg Patient Satisfaction = 7/10</p>
            </div>
            <hr class="chartDivider">
            <div class="chartCanvas">
                <canvas class="kpiCanvas" id="kpi3b"></canvas>
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    const ctx3b = document.getElementById('kpi3b');
                    var dataArray3b = {{ Js::from($kpiThreeBData) }};

                    new Chart(ctx3b, {
                        type: 'bar',
                        data: {
                        labels: ['2018', '2019', '2020', '2021', '2022'],
                        datasets: [{
                            label: 'Avg Satisfaction Score',
                            data: dataArray3b,
                            borderWidth: 1,
                            backgroundColor: [
                                'rgb(204, 201, 161)',
                                'rgb(94, 105, 115)',
                                'rgb(165, 63, 43)',
                                'rgb(76, 35, 10)',
                                'rgb(40, 0, 4)'
                            ]
                        }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                </script>
            </div>
        </div>

        <!-- KPI 4a -->
        <div class="chartCard">
            <div class="chartCardTitleRow">
                <p id="kpiTitle">KPI4a (leading): Average number of staff assigned per shift</p>
                <p id="kpiTarget">Target: An average of 12 staff assigned per shift</p>
            </div>
            <hr class="chartDivider">
            <div class="chartCanvas">
                <canvas class="kpiCanvas" id="kpi4a"></canvas>
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    const ctx4a = document.getElementById('kpi4a');
                    var dataArray4a = {{ Js::from($kpiFourAData[0]) }};

                    new Chart(ctx4a, {
                        type: 'line',
                        data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                        datasets: [{
                            label: 'Average Staff per Shift',
                            data: dataArray4a,
                            fill: false,
                            borderColor: 'rgb(75, 192, 192)',
                            tension: 0.1
                        }]
                        },
                        options: {
                        }
                    });
                </script>
            </div>
        </div>

        <!-- KPI 4b -->
        <div class="chartCard">
            <div class="chartCardTitleRow">
                <p id="kpiTitle">KPI4b (lagging):  General and Administrative Expenses</p>
                <p id="kpiTarget">Target: 10% reduction in General and Administrative Expenses</p>
            </div>
            <hr class="chartDivider">
            <div class="chartCanvas">
                <canvas class="kpiCanvas"></canvas>
            </div>
        </div>

    </div>
    
</body>
</html>
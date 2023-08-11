<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nairobi Hospice | Dashboard</title>
    
    <!-- Scripts -->
    @vite('resources/css/dashboard.css')
</head>
<body>

    <div class="navigationBar">
        <div class="userNavName">Welcome, <b>{{ Auth::user()->name }}</b></div>
        <div class="navHeader">Nairobi Hospice Patient Management</div>
        <div class="navLinks">
            <a href="{{ URL('/profile') }}" class="navlinkitem">Profile</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" id="logoutBtn">Log Out</button>
            </form>
        </div>
    </div>

    <div class="statsSection">
        <div class="statCard">
            <p class="statHeader">Total Staff</p>
            <p class="statValue">{{ App\Models\User::where('user_type', 'user')->count() }}</p>
        </div>
        <div class="statCard">
            <p class="statHeader">Active Patients</p>
            <p class="statValue">{{ App\Models\Patient::where('is_active', 1)->count() }}</p>
        </div>
        <div class="statCard">
            <p class="statHeader">Total Patients</p>
            <p class="statValue">{{ App\Models\Patient::all()->count() }}</p>
        </div>
    </div>

    @if(session('error'))
        <div class="errorMessage">
            {{ session('error') }}
        </div>
    @endif

    <div class="searchBarSection">
        <form action="{{ route('searchPatient') }}" method="post">
            @csrf
            <label for="patientID" id="patientIDLabel">Patient ID Number:</label><br>
            <input type="text" id="patientID" name="patientID" required><br>
            <div class="searchSubmitBtnContainer">
                <button type="submit" id="searchSubmitBtn">Search</button>
            </div>
        </form>
    </div>

    @if(session('patientList'))
        <div class="searchResults">
            <table class="patientResultTable">
                <tr class="tableHeadingRow">
                    <th class="tableHeading">Is Active</th>
                    <th class="tableHeading">ID Number</th>
                    <th class="tableHeading">Name</th>
                    <th class="tableHeading">Created At</th>
                    <th class="tableActionHeading"></th>
                </tr>
                @foreach(session('patientList') as $patient)
                <tr class="searchItemRow">
                    @if($patient->is_active == 1)
                    <td class="searchResActivity" style="color: green;">Active</td>
                    @else
                    <td class="searchResActivity" style="color: red;">Not Active</td>
                    @endif
                    <td class="searchResID">{{ $patient->id_number }}</td>
                    <td class="searchResName">{{ $patient->f_name }} {{ $patient->l_name }}</td>
                    <td class="searchResID">{{ $patient->created_at }}</td>
                    <td class="searchResAction">
                        <form action="{{ route('patientSummary', $patient->id_number) }}" method="post">
                            @csrf
                            <input type="submit" id="goToPatientBtn" value="Go To Patient">
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    @endif

    <hr class="horiBar">

    <div class="addPatientContainer">
        <h2 class="addPatientSectionTitle">Add New Patient</h2>

        @if(session('passwordError'))
            <div class="errorMessage">
                {{ session('passwordError') }}
            </div>
        @endif

        <form action="{{ route('addPatient') }}" method="post" class="addPatientForm">
            @csrf
            <label for="newIDNumber" id="addPatientLabel">Patient ID Number:</label>
            <br>
            <input type="text" name="newIDNumber" id="addPatientInput" required>
            <br>

            <label for="newFName" id="addPatientLabel">Patient First Name:</label>
            <br>
            <input type="text" name="newFName" id="addPatientInput" required>
            <br>

            <label for="newLName" id="addPatientLabel">Patient Last Name:</label>
            <br>
            <input type="text" name="newLName" id="addPatientInput" required>
            <br>

            <label for="" id="addPatientLabel">Sex:</label><br>
            <input type="radio" name="newSex" id="newMaleSex" value="M" required>
            <label for="newMaleSex" id="addPatientLabel">Male</label>
            <br>
            <input type="radio" name="newSex" id="newFemaleSex" value="F" required>
            <label for="newFemaleSex" id="addPatientLabel">Female</label>
            <br>

            <label for="newDOB" id="addPatientLabel">Patient Date of Birth:</label>
            <br>
            <input type="date" name="newDOB" id="addPatientInput" required>
            <br>

            <label for="newPhone" id="addPatientLabel">Patient Phone Number:</label>
            <br>
            <input type="text" name="newPhone" id="addPatientInput" required>
            <br>

            <div class="addPatientBtnContainer">
                <input type="submit" value="Add Patient" id="addNewPatientBtn">
            </div>
        </form>
    </div>

    <hr class="horiBar">

    <div class="addPatientContainer">
        <h2 class="addPatientSectionTitle">Make A Prediction</h2>

        @if(session('predictionData'))
            <div class="errorMessage">
                {{ session('predictionData') }}
            </div>
        @endif

        <form action="{{ route('makePrediction') }}" method="post" class="addPatientForm">
            @csrf
            <label for="arg_fever" id="addPatientLabel">Fever</label><br>
            <input type="text" id="addPatientInput" name="arg_fever" placeholder="arg_fever" required><br>

            <label for="arg_cough" id="addPatientLabel">Cough</label><br>
            <input type="text" id="addPatientInput" name="arg_cough" placeholder="arg_cough" required><br>

            <label for="arg_fatigue" id="addPatientLabel">Fatigue</label><br>
            <input type="text" id="addPatientInput" name="arg_fatigue" placeholder="arg_fatigue" required><br>

            <label for="arg_diff_breathing" id="addPatientLabel">Difficulty Breathing</label><br>
            <input type="text" id="addPatientInput" name="arg_diff_breathing" placeholder="arg_diff_breathing" required><br>

            <label for="arg_age" id="addPatientLabel">Age</label><br>
            <input type="text" id="addPatientInput" name="arg_age" placeholder="arg_age" required><br>

            <label for="arg_gender" id="addPatientLabel">Gender</label><br>
            <input type="text" id="addPatientInput" name="arg_gender" placeholder="arg_gender" required><br>
            
            <label for="arg_bp" id="addPatientLabel">Blood Pressure</label><br>
            <input type="text" id="addPatientInput" name="arg_bp" placeholder="arg_bp" required><br>

            <label for="arg_cholesterol_lvl" id="addPatientLabel">Cholesterol Level</label><br>
            <input type="text" id="addPatientInput" name="arg_cholesterol_lvl" placeholder="arg_cholesterol_lvl" required><br>

            <div class="addPatientBtnContainer">
                <input type="submit" value="Make Prediction" id="addNewPatientBtn">
            </div>
        </form>
    </div>
</body>
</html>
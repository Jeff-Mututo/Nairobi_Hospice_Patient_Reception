<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nairobi Hospice | Patient Summary</title>

    <!-- Scripts -->
    @vite(['resources/css/patientSummary.css'])

    <script type="application/javascript">
        function toggleForm(formID){
            var x = document.getElementById(formID);
            
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }

        function openDetail(evt, detailName) {
            // Declare all variables
            var i, tabcontent, tablinks;

            // Get all elements with class="tabcontent" and hide them
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            // Get all elements with class="tablinks" and remove the class "active"
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }

            // Show the current tab, and add an "active" class to the button that opened the tab
            document.getElementById(detailName).style.display = "block";
            evt.currentTarget.className += " active";
        }
    </script>
</head>
<body>
    <div class="navigationBar">
        <div class="userNavName">Welcome, <b>{{ Auth::user()->name }}</b></div>
        <div class="navHeader">Patient Summary</div>
        <div class="navLinks">
            <a href="{{ URL('/checkUserType') }}" class="navlinkitem">Dash</a>
            <a href="{{ URL('/profile') }}" class="navlinkitem">Profile</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" id="logoutBtn">Log Out</button>
            </form>
        </div>
    </div>

    @if(session('error'))
        <div class="errorMessage">
            {{ session('error') }}
        </div>
    @endif

    @if(isset($patient))
        <div class="summaryContainer">
            <div class="shortDetails">
                <div class="detailCard">
                    <div class="pictureContainer">
                        @if($patient->sex == 'F')
                        <img class="profilePicture" src="{{ asset('images/femaleProfile.jpg') }}" alt="Generic Female Profile Picture">
                        @elseif($patient->sex == 'M')
                        <img class="profilePicture" src="{{ asset('images/maleProfile.jpg') }}" alt="Generic Male Profile Picture">
                        @endif
                    </div>

                    <p class="patientName">{{ $patient->f_name }} {{ $patient->l_name }}</p>

                    @if($patient->is_active == 1)
                    <p class="statusIsActive">Active</p>
                    @else
                    <p class="statusIsNotActive">Not Active</p>
                    @endif

                    <div class="personalItemHori">
                        <p class="personalItemTitle">Sex</p>
                        <p class="personalItemValue">{{ $patient->sex }}</p>
                    </div>
                    <div class="personalItemHori">
                        <p class="personalItemTitle">DOB</p>
                        <p class="personalItemValue">{{ $patient->date_of_birth }}</p>
                    </div>
                    <div class="personalItemHori">
                        <p class="personalItemTitle">Phone No.</p>
                        <p class="personalItemValue">{{ $patient->phone_no }}</p>
                    </div>
                    <div class="personalItemHori">
                        <p class="personalItemTitle">Height</p>
                        @if(!is_null($patient->height))
                        <p class="personalItemValue">{{ $patient->height }}cm</p>
                        @else
                        <p class="personalItemValue">Not Logged</p>
                        @endif
                    </div>
                    <div class="personalItemHori">
                        <p class="personalItemTitle">Weight</p>
                        @if(!is_null($patient->weight))
                        <p class="personalItemValue">{{ $patient->weight }}kg</p>
                        @else
                        <p class="personalItemValue">Not Logged</p>
                        @endif
                    </div>
                </div>

                <div class="detailCard">
                    <div class="detailTitleSection">
                        <p class="detailCardTitle">Allergies</p>
                        <div class="addActionButton" onclick="toggleForm('addAllergySection')">&#8595;</div>
                    </div>

                    <div class="addSection" id="addAllergySection">
                        <form action="{{ route('addAllergy') }}" method="post">
                            @csrf
                            <input class="addAllergyField" type="text" name="allergy_name" id="allergy_name" placeholder="Enter Allergy" required><br>
                            <select class="addAllergyField" name="severity" id="severity" required>
                                <option value="Severe" class="severityOption">Severe</option>
                                <option value="Medium" class="severityOption">Medium</option>
                                <option value="Mild" class="severityOption">Mild</option>
                            </select><br>
                            <input type="hidden" name="currPatient" id="currPatient" value="{{ $patient->id }}">
                            <input class="addActionButton" type="submit" value="+">
                        </form>
                    </div>

                    <hr class="detailSeparator">

                    <div class="detailInfoSection">
                        @if(isset($allergies) && !empty($allergies[0]))
                        <table class="allergyTable">
                            @foreach($allergies as $allergy)
                                <tr class="allergyDataRow">
                                    <td class="allergyData">{{ $allergy->allergy_name }}</td>

                                    @if($allergy->severity == "Severe")
                                    <td class="allergyDataSevere">{{ $allergy->severity }}</td>
                                    @elseif($allergy->severity == "Medium")
                                    <td class="allergyDataMed">{{ $allergy->severity }}</td>
                                    @elseif($allergy->severity == "Mild")
                                    <td class="allergyDataMild">{{ $allergy->severity }}</td>
                                    @else
                                    <td class="allergyData">{{ $allergy->severity }}</td>
                                    @endif

                                    <td class="allergyAction">
                                        <form action="{{ route('deleteAllergy', $allergy->id) }}" method="post" class="deleteRecord">
                                            @csrf
                                            <input type="hidden" name="currPatient" id="currPatient" value="{{ $patient->id }}">
                                            <input type="submit" value="-" id="deleteRecordBtn">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        @else
                        <p class="personalItemValue">No Allergies Logged</p>
                        @endif
                    </div>
                </div>

                <div class="detailCard mainActionCard">
                    @if($patient->is_active == 1)
                        <form action="{{ route('toggleActivation') }}" method="post" class="mainAction">
                            @csrf
                            <input type="hidden" name="currPatient" id="currPatient" value="{{ $patient->id }}">
                            <input type="submit" value="DEACTIVATE" id="deletePatient">
                        </form>
                    @else
                        <form action="{{ route('toggleActivation') }}" method="post" class="mainAction">
                            @csrf
                            <input type="hidden" name="currPatient" id="currPatient" value="{{ $patient->id }}">
                            <input type="submit" value="ACTIVATE" id="toggleActivate">
                        </form>
                    @endif
                    
                    <form action="{{ route('deletePatient') }}" method="post" class="mainAction">
                        @csrf
                        <input type="hidden" name="currPatient" id="currPatient" value="{{ $patient->id }}">
                        <input type="submit" value="DELETE PATIENT" id="deletePatient">
                    </form>
                </div>
            </div>

            <div class="longDetails">
                <!-- Tab links -->
                <div class="tabLinkRow">
                    <button class="tablinks" onclick="openDetail(event, 'Details')">Details</button>
                </div>

                <!-- Tab Content -->
                <div class="tabcontent" id="Details" style="display: block;">
                    <div class="tabDetailCard">
                        <div class="detailTitleSection">
                            <p class="detailCardTitle">Personal Details</p>
                        </div>

                        <hr class="detailSeparator">

                        <div class="detailInfoSection">
                            <div class="personalItemHori">
                                <div class="personalItemVert">
                                    <div class="personalDetailTitleRow">
                                        <p class="personalDetailTitle">Last Name</p>
                                        <div class="addActionButton" onclick="toggleForm('updateLName')">&#8595;</div>
                                    </div>
                                    <form action="{{ route('updateLName') }}" method="post" class="updates" id="updateLName">
                                        @csrf
                                        <input type="text" name="l_name" id="l_name" required>
                                        <input type="hidden" name="currPatient" id="currPatient" value="{{ $patient->id }}">
                                        <input type="submit" class="addActionButton" value="+">
                                    </form>
                                    <p class="personalItemValue">{{ $patient->l_name }}</p>
                                </div>

                                <div class="personalItemVert">
                                    <div class="personalDetailTitleRow">
                                        <p class="personalDetailTitle">First Name</p>
                                        <div class="addActionButton" onclick="toggleForm('updateFName')">&#8595;</div>
                                    </div>
                                    <form action="{{ route('updateFName') }}" method="post" class="updates" id="updateFName">
                                        @csrf
                                        <input type="text" name="f_name" id="f_name" required>
                                        <input type="hidden" name="currPatient" id="currPatient" value="{{ $patient->id }}">
                                        <input type="submit" class="addActionButton" value="+">
                                    </form>
                                    <p class="personalItemValue">{{ $patient->f_name }}</p>
                                </div>

                                <div class="personalItemVert">
                                    <div class="personalDetailTitleRow">
                                        <p class="personalDetailTitle">Date Of Birth</p>
                                        <div class="addActionButton" onclick="toggleForm('updateDOB')">&#8595;</div>
                                    </div>
                                    <form action="{{ route('updateDOB') }}" method="post" class="updates" id="updateDOB">
                                        @csrf
                                        <input type="date" name="date_of_birth" id="date_of_birth" required>
                                        <input type="hidden" name="currPatient" id="currPatient" value="{{ $patient->id }}">
                                        <input type="submit" class="addActionButton" value="+">
                                    </form>
                                    <p class="personalItemValue">{{ $patient->date_of_birth }}</p>
                                </div>
                            </div>

                            <div class="personalItemVert">
                                <div class="personalDetailTitleRow">
                                    <p class="personalDetailTitle">Current Address</p>
                                    <div class="addActionButton" onclick="toggleForm('updateAddress')">&#8595;</div>
                                </div>
                                <form action="{{ route('updateAddress') }}" method="post" class="updates" id="updateAddress">
                                    @csrf
                                    <input type="text" name="patientAddress" id="patientAddress" required>
                                    <input type="hidden" name="currPatient" id="currPatient" value="{{ $patient->id }}">
                                    <input type="submit" class="addActionButton" value="+">
                                </form>
                                @if(!is_null($patient->address))
                                <p class="personalItemValue">{{ $patient->address }}</p>
                                @else
                                <p class="personalItemValue">No Address Recorded!</p>
                                @endif
                            </div>

                            <div class="personalItemHori">
                                <div class="personalItemVert">
                                    <div class="personalDetailTitleRow">
                                        <p class="personalDetailTitle">Phone No.</p>
                                        <div class="addActionButton" onclick="toggleForm('updatePhone')">&#8595;</div>
                                    </div>
                                    <form action="{{ route('updatePhone') }}" method="post" class="updates" id="updatePhone">
                                        @csrf
                                        <input type="number" name="phone_no" id="phone_no" required>
                                        <input type="hidden" name="currPatient" id="currPatient" value="{{ $patient->id }}">
                                        <input type="submit" class="addActionButton" value="+">
                                    </form>
                                    <p class="personalItemValue">{{ $patient->phone_no }}</p>
                                </div>

                                <div class="personalItemVert">
                                    <div class="personalDetailTitleRow">
                                        <p class="personalDetailTitle">Height</p>
                                        <div class="addActionButton" onclick="toggleForm('updateHeight')">&#8595;</div>
                                    </div>
                                    <form action="{{ route('updateHeight') }}" method="post" class="updates" id="updateHeight">
                                        @csrf
                                        <input type="number" name="height" id="height" required>
                                        <input type="hidden" name="currPatient" id="currPatient" value="{{ $patient->id }}">
                                        <input type="submit" class="addActionButton" value="+">
                                    </form>
                                    @if(!is_null($patient->height))
                                    <p class="personalItemValue">{{ $patient->height }}cm</p>
                                    @else
                                    <p class="personalItemValue">Not Logged!</p>
                                    @endif
                                </div>

                                <div class="personalItemVert">
                                    <div class="personalDetailTitleRow">
                                        <p class="personalDetailTitle">Weight</p>
                                        <div class="addActionButton" onclick="toggleForm('updateWeight')">&#8595;</div>
                                    </div>
                                    <form action="{{ route('updateWeight') }}" method="post" class="updates" id="updateWeight">
                                        @csrf
                                        <input type="number" name="weight" id="weight" required>
                                        <input type="hidden" name="currPatient" id="currPatient" value="{{ $patient->id }}">
                                        <input type="submit" class="addActionButton" value="+">
                                    </form>
                                    @if(!is_null($patient->weight))
                                    <p class="personalItemValue">{{ $patient->weight }}kg</p>
                                    @else
                                    <p class="personalItemValue">Not Logged!</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- End Of Tab Content -->

                <div class="detailCard">
                    <div class="detailTitleSection">
                        <p class="detailCardTitle">Symptoms</p>
                        <div class="patientAction" onclick="toggleForm('addSymptomSection')">Add Symptom</div>
                    </div>

                    <div class="addSection" id="addSymptomSection">
                        <form action="{{ route('addSymptom') }}" method="post">
                            @csrf
                            <div class="symptomList">
                                <table class="symptomTable">
                                    <tr class="sympHeaderRow">
                                        <th class="sympHeader">Body Part</th>
                                        <th class="sympHeader">Ailment</th>
                                        <th class="sympHeader">Severity</th>
                                        <th class="sympHeader"></th>
                                    </tr>
                                    <tr class="sympDataRow">
                                            <td class="sympData">
                                                <input class="addBodyPart" type="text" name="body_part" id="addSymptomInput" placeholder="Enter Body Part" required>
                                            </td>
                                            <td class="sympData">
                                                <input class="addAilment" type="text" name="ailment" id="addSymptomInput" placeholder="Enter Ailment" required>
                                            </td>
                                            <td class="sympDataSevere">
                                            <select name="severity" id="addSymptomInput" required>
                                                <option value="Severe" class="severityOption">Severe</option>
                                                <option value="Medium" class="severityOption">Medium</option>
                                                <option value="Mild" class="severityOption">Mild</option>
                                            </select>
                                            </td>
                                            <td class="sympData">
                                                <input type="hidden" name="currPatient" id="currPatient" value="{{ $patient->id }}">
                                                <input class="addActionButton" type="submit" value="+">
                                            </td>
                                        </tr>
                                </table>
                            </div>
                        </form>
                    </div>

                    <hr class="detailSeparator">

                    <div class="detailInfoSection">
                        @if(isset($symptoms) && !empty($symptoms[0]))
                            <div class="symptomList">
                                <table class="symptomTable">
                                    <tr class="sympHeaderRow">
                                        <th class="sympHeader">Body Part</th>
                                        <th class="sympHeader">Ailment</th>
                                        <th class="sympHeader">Severity</th>
                                        <th class="sympHeader"></th>
                                    </tr>
                                    @foreach($symptoms as $symptom)
                                        <tr class="sympDataRow">
                                            <td class="sympData">{{ $symptom->body_part }}</td>
                                            <td class="sympData">{{ $symptom->ailment }}</td>

                                            @if($symptom->severity == "Severe")
                                            <td class="sympDataSevere">{{ $symptom->severity }}</td>
                                            @elseif($symptom->severity == "Medium")
                                            <td class="sympDataMed">{{ $symptom->severity }}</td>
                                            @elseif($symptom->severity == "Mild")
                                            <td class="sympDataMild">{{ $symptom->severity }}</td>
                                            @else
                                            <td class="sympData">{{ $symptom->severity }}</td>
                                            @endif

                                            <td class="sympData">
                                                <form action="{{ route('deleteSymptom', $symptom->id) }}" method="post" class="deleteRecord">
                                                    @csrf
                                                    <input type="hidden" name="currPatient" id="currPatient" value="{{ $patient->id }}">
                                                    <input type="submit" value="-" id="deleteRecordBtn">
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        @else
                            <p>No Symptoms Added!</p>
                        @endif
                    </div>
                </div>

                <div class="detailCard">
                    <div class="detailTitleSection">
                        <p class="detailCardTitle">Prescriptions</p>
                        <div class="patientAction" onclick="toggleForm('addPrescriptionSection')">Add Prescription</div>
                    </div>

                    <div class="addSection" id="addPrescriptionSection">
                        <form action="{{ route('addPrescription') }}" method="post">
                            @csrf
                            <div class="prescriptionList">
                                <table class="prescriptionTable">
                                    <tr class="presHeaderRow">
                                        <th class="presHeader">Brand Name</th>
                                        <th class="presHeader">Generic Name</th>
                                        <th class="presHeader">Strength</th>
                                        <th class="presHeader">Date Prescribed</th>
                                        <th class="presHeader"></th>
                                    </tr>
                                    <tr class="presDataRow">
                                        <td class="presData">
                                            <input class="addBrandName" type="text" name="brand_name" id="addPrescriptionInput" placeholder="Brand Name" required>
                                        </td>
                                        <td class="presData">
                                            <input class="addGenName" type="text" name="generic_name" id="addPrescriptionInput" placeholder="Generic Name" required>
                                        </td>
                                        <td class="presData">
                                            <input class="addStrength" type="text" name="strength" id="addPrescriptionInput" placeholder="Strength(in mg)" required>
                                        </td>
                                        <td class="presData">
                                            <input class="addDatePrescribed" type="date" name="date_prescribed" id="addPrescriptionInput" required>
                                        </td>
                                        <td class="presData">
                                            <input type="hidden" name="currPatient" id="currPatient" value="{{ $patient->id }}">
                                            <input class="addActionButton" type="submit" value="+">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <!--
                            <input class="addBrandName" type="text" name="brand_name" id="brand_name" placeholder="Enter Brand Name" required>
                            <input class="addGenName" type="text" name="generic_name" id="generic_name" placeholder="Enter Generic Name" required>
                            <input class="addStrength" type="text" name="strength" id="strength" placeholder="Enter Strength(in mg)" required>
                            <input class="addDatePrescribed" type="date" name="date_prescribed" id="date_prescribed" required>
                            <input type="hidden" name="currPatient" id="currPatient" value="{{ $patient->id }}">
                            <input class="addActionButton" type="submit" value="+">
                            -->
                        </form>
                    </div>

                    <hr class="detailSeparator">

                    <div class="detailInfoSection">
                        @if(isset($prescriptions) && !empty($prescriptions[0]))
                            <div class="prescriptionList">
                                <table class="prescriptionTable">
                                    <tr class="presHeaderRow">
                                        <th class="presHeader">Brand Name</th>
                                        <th class="presHeader">Generic Name</th>
                                        <th class="presHeader">Strength</th>
                                        <th class="presHeader">Date Prescribed</th>
                                        <th class="presHeader"></th>
                                    </tr>
                                    @foreach($prescriptions as $prescription)
                                        <tr class="presDataRow">
                                            <td class="presData">{{ $prescription->brand_name }}</td>
                                            <td class="presData">{{ $prescription->generic_name }}</td>
                                            <td class="presData">{{ $prescription->strength }}mg</td>
                                            <td class="presData">{{ $prescription->date_prescribed }}</td>
                                            <td class="presData">
                                                <form action="{{ route('deletePrescription', $prescription->id) }}" method="post" class="deleteRecord">
                                                    @csrf
                                                    <input type="hidden" name="currPatient" id="currPatient" value="{{ $patient->id }}">
                                                    <input type="submit" value="-" id="deleteRecordBtn">
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        @else
                            <p>No Prescriptions Added!</p>
                        @endif
                    </div>
                </div>

                <div class="detailCard">
                    <div class="detailTitleSection">
                        <p class="detailCardTitle">Patient Notes</p>
                        <div class="patientAction" onclick="toggleForm('addNoteSection')">Add Note</div>
                    </div>

                    <div class="addSection" id="addNoteSection">
                        <form action="{{ route('addNote') }}" method="post">
                            @csrf
                            <textarea name="note_body" id="note_body" required>Enter Note</textarea>
                            <input type="hidden" name="currPatient" id="currPatient" value="{{ $patient->id }}">
                            <input class="addActionButton" type="submit" value="+">
                        </form>
                    </div>

                    <hr class="detailSeparator">

                    <div class="detailInfoSection">
                        <div class="personalItemVert">
                            @if(isset($notes) && !empty($notes[0]))
                                @foreach($notes as $note)
                                <div class="noteCard">
                                    <div class="noteTitleRow">
                                        <p class="personalItemValue"><b>Author:</b> {{ $note->author }}</p>
                                        <p class="personalItemValue"><b>Date:</b> {{ $note->created_at }}</p>
                                    </div>
                                    <p class="personalItemValue">{{ $note->note_body }}</p>
                                    <form action="{{ route('deleteNote', $note->id) }}" method="post" class="deleteSymptom">
                                        @csrf
                                        <input type="hidden" name="currPatient" id="currPatient" value="{{ $patient->id }}">
                                        <input type="submit" value="Delete" id="deleteRecordBtn">
                                    </form>
                                </div>
                                @endforeach
                            @else
                            <p class="personalItemValue">No Notes Added!</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <h1>No Patient Info</h1>
    @endif
</body>
</html>
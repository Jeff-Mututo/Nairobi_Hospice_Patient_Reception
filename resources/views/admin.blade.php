<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nairobi Hospice | Admin Panel</title>

    <!-- Scripts -->
    @vite('resources/css/admin.css')
</head>
<body>

    <div class="navigationBar">
        <div class="userNavName">Welcome, <b>{{ Auth::user()->name }}</b></div>
        <div class="navHeader">Nairobi Hospice Admin Panel</div>
        <div class="navLinks">
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

    <div class="searchBarSection">
        <form class="searchUserForm" action="{{ route('searchUser') }}" method="post">
            @csrf
            <label for="userEmail" id="userEmailLabel">Enter Email Portion: (Ex: gmail, @, user)</label><br>
            <input type="text" id="userEmail" name="userEmail" required><br>
            <div class="searchSubmitBtnContainer">
                <button type="submit" id="searchSubmitBtn">Search</button>
            </div>
        </form>
    </div>

    @if(session('userList'))
        <div class="searchResults">
            <table class="userResultTable">
                <tr class="tableHeadingRow">
                    <th class="tableHeading">Privilege</th>
                    <th class="tableHeading">Name</th>
                    <th class="tableHeading">Email</th>
                    <th class="tableActionHeading"></th>
                    <th class="tableActionHeading"></th>
                </tr>
                @foreach(session('userList') as $user)
                <tr class="searchItemRow">
                    <td class="searchResUserType">{{ $user->user_type }}</td>
                    <td class="searchResName">{{ $user->name }}</td>
                    <td class="searchResEmail">{{ $user->email }}</td>
                    <td class="searchResAction">
                        <form action="{{ route('changePrivilege', $user->id) }}" method="post">
                            @csrf
                            <input type="submit" id="changePrivilegeBtn" value="Change Privilege">
                        </form>
                    </td>
                    <td class="searchResAction">
                        <form action="{{ route('deleteUser', $user->id) }}" method="post">
                            @csrf
                            <input type="submit" id="deleteAccBtn" value="Delete Account">
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    @endif

    <hr class="horiBar">

    <div class="addUserContainer">
        <h2 class="addUserSectionTitle">Add New User</h2>

        @if(session('passwordError'))
            <div class="errorMessage">
                {{ session('passwordError') }}
            </div>
        @endif

        <form action="{{ route('addUser') }}" method="post" class="addUserForm">
            @csrf
            <label for="username" id="addUserLabel">Name:</label><br>
            <input type="text" name="username" id="addUserInput" required><br>

            <label for="useremail" id="addUserLabel">Email:</label><br>
            <input type="email" name="useremail" id="addUserInput" required><br>

            <label for="userpassword" id="addUserLabel">Password:</label><br>
            <input type="password" name="userpassword" id="addUserInput" required><br>

            <label for="userconfirmpassword" id="addUserLabel">Confirm Password:</label><br>
            <input type="password" name="userconfirmpassword" id="addUserInput" required><br>

            <div class="addUserBtnContainer">
                <input type="submit" value="Add User" id="addNewUserBtn">
            </div>
        </form>
    </div>
    
</body>
</html>
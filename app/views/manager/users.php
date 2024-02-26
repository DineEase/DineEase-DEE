<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <style>
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            text-align: center;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .add-user-button, .search-button {
            padding: 10px;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            cursor: pointer;
            display: inline-block;
            margin-top: 15px;
        }

        .add-user-button:hover, .search-button:hover {
            background-color: #2980b9;
        }

        .search-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }

        .search-input {
            flex: 1;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-right: 5px;
        }

        .search-button {
            padding: 8px;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .search-button:hover {
            background-color: #2980b9;
        }

        .buttonGroup {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }

        button[type="reset"] {
            background-color: #e74c3c;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            padding: 8px;
        }

        button[type="reset"]:hover {
            background-color: #c0392b;
        }
        .home-link {
    padding: 10px;
    background-color: #2ecc71; /* Change the background color as per your design */
    color: #fff;
    text-decoration: none;
    border-radius: 4px;
    cursor: pointer;
    display: inline-block;
    margin-top: 15px;
}

.home-link:hover {
    background-color: #27ae60; /* Change the background color on hover as per your design */
}
td.name-cell a {
    text-decoration: none; /* Remove default underline */
    color: #3498db; /* Set the default text color for names */
    transition: color 0.3s; /* Add transition for smooth color change */
}

td.name-cell a:hover {
    text-decoration: underline; /* Add underline on hover */
    color: #2980b9; /* Change text color on hover */
}
    </style>
</head>
<body>

<header>
    <h1>User Management Dashboard</h1>
</header>

<div class="container">
    <div class="search-container">
        <form action="<?php echo URLROOT; ?>/managers/searchemployeebyname" method="GET">
            <input type="text" name="searchQuery" class="search-input" placeholder="Search by name">
            <button type="submit" class="search-button">Search</button>
        </form>

        <form id="roleFilterForm" action="<?php echo URLROOT; ?>/managers/filterbyrole" method="GET">
            <label for="role">Choose a role:</label>
            <select id="role" name="role" onchange="submitForm()">
                <option value="All Users">All Users</option>
                <option value="Inventory Manager">Inventory Manager</option>
                <option value="Receptionist">Receptionist</option>
                <option value="Chef">Chef</option>
            </select>
        </form>
    </div>

    <div class="buttonGroup">
        <a href="<?php echo URLROOT; ?>/managers/addUsers" class="add-user-button">Add New User</a>
        <a href="<?php echo URLROOT; ?>/managers/searchUsers" class="add-user-button">Promote Customer</a>
        <a href="<?php echo URLROOT; ?>/managers/index" class="home-link">Home</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile Number</th>
                <th>Role</th>
                <th>Address</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['users'] as $user): ?>
                <tr>
                    <td class="name-cell">
                        <?php echo '<a href="' . URLROOT . '/managers/viewprofile/' . $user['user_id'] . '">' . (isset($user['name']) ? $user['name'] : $user->name) . '</a>'; ?>
                    </td>
                    <td><?php echo isset($user['email']) ? $user['email'] : $user->email; ?></td>
                    <td><?php echo isset($user['mobile_no']) ? $user['mobile_no'] : $user->mobile_no; ?></td>
                    <td><?php echo isset($user['role_name']) ? $user['role_name'] : $user->role_name; ?></td>
                    <td><?php echo isset($user['address']) ? $user['address'] : $user->address; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php if (!empty($data['nonactiveusers'])): ?>
    <h2>Non-Activated Users</h2>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile Number</th>
                <th>Role</th>
                <th>Address</th>
                <th>Activate</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['nonactiveusers'] as $user): ?>
                <tr>
                    <td class="name-cell">
                        <?php echo '<a href="' . URLROOT . '/managers/viewprofile/' . $user['user_id'] . '">' . (isset($user['name']) ? $user['name'] : $user->name) . '</a>'; ?>
                    </td>
                    <td><?php echo isset($user['email']) ? $user['email'] : $user->email; ?></td>
                    <td><?php echo isset($user['mobile_no']) ? $user['mobile_no'] : $user->mobile_no; ?></td>
                    <td><?php echo isset($user['role_name']) ? $user['role_name'] : $user->role_name; ?></td>
                    <td><?php echo isset($user['address']) ? $user['address'] : $user->address; ?></td>
                    <td><?php echo '<a href="' . URLROOT . '/managers/manuallyactivateemployee/' . $user['user_id'] . '">Activate</a>'; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
</div>

<script>
    function setSelectedRole() {
        var selectedRole = document.getElementById("role").value;
        localStorage.setItem("selectedRole", selectedRole);
    }

    function submitForm() {
        setSelectedRole();
        var selectedRole = document.getElementById("role").value;

        if (selectedRole === "All Users") {
            window.location.href = "<?php echo URLROOT; ?>/managers/getUsers";
        } else {
            document.getElementById("roleFilterForm").submit();
        }
    }

    function setInitialSelectedRole() {
        var selectedRole = localStorage.getItem("selectedRole");
        if (selectedRole) {
            document.getElementById("role").value = selectedRole;
        }
    }

    window.onload = setInitialSelectedRole;
</script>

</body>
</html>

<!DOCTYPE html />
<html lang="en">
    <head>
        <title>User Profile</title>
        </head>
        <body>&nbsp;<br/>
        <h1>User Profile</h1>
        <table class="table">
        <tr><td><b>User ID</b></td><td><?php echo $user['username']; ?>&nbsp;<span class="glyphicon glyphicon-lock" aria-hidden="true" onclick="preventEdit('USERNAME');"></span></td></tr>
        <tr><td><b>Name</b></td><td><?php echo $user['name']; ?>&nbsp;<span class="glyphicon glyphicon-edit" aria-hidden="true" onclick="editname('<?php echo $user['email']; ?>','<?php echo $user['phone']; ?>');"></span></td></tr>
        <tr><td><b>E-mail</b></td><td><?php echo $user['email']; ?>&nbsp;<span class="glyphicon glyphicon-lock" aria-hidden="true" onclick="preventEdit('EMAIL');"></span></td></tr>
        <tr><td><b>Phone Number</b></td><td><?php echo $user['phone']; ?>&nbsp;<span class="glyphicon glyphicon-lock" aria-hidden="true" onclick="preventEdit('PHONE NUMBER');"></span></td></tr>
        <tr><td><b>Date Registered</b></td><td><?php echo $user['dateReg']; ?>(<?php echo $since; ?> )</td></tr>
        <tr><td><b>City</b></td><td><?php echo $user['city']; ?>&nbsp;<span class="glyphicon glyphicon-edit" aria-hidden="true" onclick="editcity('<?php echo $user['email']; ?>','<?php echo $user['phone']; ?>');"></span></td></tr>
        <tr><td><b>State</b></td><td><?php echo $user['state']; ?>&nbsp;<span class="glyphicon glyphicon-edit" aria-hidden="true" onclick="editstate('<?php echo $user['email']; ?>','<?php echo $user['phone']; ?>');"></span></td></tr>
        <tr><td><b>Country</b></td><td><?php echo $user['country']; ?>&nbsp;<span class="glyphicon glyphicon-edit" aria-hidden="true" onclick="editctry('<?php echo $user['email']; ?>','<?php echo $user['phone']; ?>');"></span></td></tr>
        <tr><td><b>Account Status</b></td><td><?php if ($user['status'] == 1): ?><?php echo CONFIRMED; ?><?php else: ?><?php echo "NOT CONFIRMED"; ?><?php endif; ?></td></tr>
        <tr><td><b>Expiration Status</b></td><td><?php if ($user['expired'] == 1): ?><?php echo "ACCOUNT EXPIRED"; ?><?php else: ?><?php echo ACTIVE; ?><?php endif; ?></td></tr>
            </table>
        </body>
    </html>

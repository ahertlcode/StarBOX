<!DOCTYPE html />
<html lang="en">
    <head>
        <title>User Profile</title>
        </head>
        <body>&nbsp;<br/>
        <h1>User Profile</h1>
        <table class="table">
        <tr><td><b>User ID</b></td><td>{{@user.username}}&nbsp;<span class="glyphicon glyphicon-lock" aria-hidden="true" onclick="preventEdit('USERNAME');"></span></td></tr>
        <tr><td><b>Name</b></td><td>{{@user.name}}&nbsp;<span class="glyphicon glyphicon-edit" aria-hidden="true" onclick="editname('{{@user.email}}','{{@user.phone}}');"></span></td></tr>
        <tr><td><b>E-mail</b></td><td>{{@user.email}}&nbsp;<span class="glyphicon glyphicon-lock" aria-hidden="true" onclick="preventEdit('EMAIL');"></span></td></tr>
        <tr><td><b>Phone Number</b></td><td>{{@user.phone}}&nbsp;<span class="glyphicon glyphicon-lock" aria-hidden="true" onclick="preventEdit('PHONE NUMBER');"></span></td></tr>
        <tr><td><b>Date Registered</b></td><td>{{@user.dateReg }}({{ @since}} )</td></tr>
        <tr><td><b>City</b></td><td>{{@user.city}}&nbsp;<span class="glyphicon glyphicon-edit" aria-hidden="true" onclick="editcity('{{@user.email}}','{{@user.phone}}');"></span></td></tr>
        <tr><td><b>State</b></td><td>{{@user.state}}&nbsp;<span class="glyphicon glyphicon-edit" aria-hidden="true" onclick="editstate('{{@user.email}}','{{@user.phone}}');"></span></td></tr>
        <tr><td><b>Country</b></td><td>{{@user.country}}&nbsp;<span class="glyphicon glyphicon-edit" aria-hidden="true" onclick="editctry('{{@user.email}}','{{@user.phone}}');"></span></td></tr>
        <tr><td><b>Account Status</b></td><td><check if="{{@user.status == 1}}"><true>{{ CONFIRMED }}</true><false>{{ "NOT CONFIRMED" }}</false></check></td></tr>
        <tr><td><b>Expiration Status</b></td><td><check if="{{@user.expired == 1}}"><true>{{ "ACCOUNT EXPIRED" }}</true><false>{{ ACTIVE }}</false></check></td></tr>
            </table>
        </body>
    </html>

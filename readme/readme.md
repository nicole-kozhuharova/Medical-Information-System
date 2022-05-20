# Medical Information System 

## Overview

Healthcare is one of the work areas which lacks digitalization. This information system was created for the convenience of both doctors and patients in a hospital. The users have access to different kinds of information concerning them. For instance, doctors can see their upcoming appointments and information about their patients. They can write digital prescriptions, which can be also accessed by their patients. Patients can also see their upcoming and past appointments.

### ------------------------------------------------------------------------------------------------------------------

## Technologies

* PHP 8.1.4 
* Bootstrap 5
* MySQL
* HTML
* CSS
* jQuery 3.5.1
* Select2 4.1.0

For the project I used XAMPP for local host. I used phpMyAdmin for handling the database of my project. 

### ------------------------------------------------------------------------------------------------------------------

## Setup

To run this project on your device, you have to use a local web stack, such as XAMPP, which I used. Here are the steps you need to perform if you use XAMPP:

1. Install XAMPP: https://www.apachefriends.org/index.html 
2. To launch Apache service and MySQL service, open the XAMPP Control Panel and click on the Start button of both services  
3. Download and extract the project zip file 
4. After extracting you should see the folder which contains all the code and related files of the project that you have downloaded
5. Copy this folder and navigate to "xampp" folder and inside the "xampp" folder find the "htdocs" folder and paste the project folder into this htdocs folder
6. The project folder name is "medical_system", so type in URL field: localhost/medical_system/ and hit enter to run the project

I personally had a problem with running XAMPP at first, because the port for MySQL, which was set by default, was not available. You might come into the same situation. You can choose another port by clicking the "config" button of MySQL from the XAMPP Control Panel. After you choose the port, you have to go to the "connect-db.php" file and in the line where the server name is initialized, you have to add the port number. Here is an example of how to do it:
I set the port to 4306 from the control panel, and then in the "connect-db.php" file, I added the port number like this: 
$servername = "localhost:4306";

### ------------------------------------------------------------------------------------------------------------------

## How to Use the Project

### Login Page

The login page is: http://localhost/medical_system/index.php 
There are two roles for user login: Patient and Doctor. You have to use one of the following login data, depending on whether you want to log in as a doctor or as a patient:

#### Login Information

 Username : 12345

 Password : 1234

 Role : Patient

### ---------------------------------

 UserName : 12346

 Password : abcd

 Role : Doctor

### ---------------------------------

 UserName : 12347

 Password : 12345

 Role : Patient

### ---------------------------------

 UserName : 12348

 Password : 123456

 Role : Patient

### ---------------------------------

 UserName : 12349

 Password : 12345

 Role : Doctor

### ---------------------------------

You can also create a new login in the database.
After you log in you will be led to the homepage, where different options are available, depending on whether you are a patient or a doctor. In the header of the page you can log out from the account anytime. The names of the user are also displayed in the header.



### Patient Login

On the homepage of each patient there are two options available: Prescriptions and Appointments. 

### ---------------------------------

#### Prescriptions:

A list with all of the prescriptions of a patient is displayed. The "View Prescription" button leads to an overview of the prescription where the user can see the content of each prescription and which doctor has prescribed it. It can be downloaded as .csv file from the "Download Prescription" button.

### ---------------------------------

#### Appointments

On this page is displayed a table with all appointments of the patient. There is information about the doctor they visited or will visit, the exact date and time of the appointment, a description of the procedure and the room number. 
The upcoming appointments are highlighted in green, and the past - in red.

### ---------------------------------


### Doctor Login

On the homepage of each patient there are two options available: Appointments and Patients. 

### ---------------------------------

#### Appointments

On this page is displayed a table with all upcoming appointments of the doctor. There they can see the patient's name, the exact date and time of the appointment and a description of the procedure. There is an "Info" button, which leads to a page with the personal information of the patient.

### ---------------------------------

#### Personal Information of Patient

On this page the doctor has access to information about the patient. Thera are some buttons: "Add Prescription", "History of Visits", "Request Laboratory Test" and "Laboratory Results". Only the "Add Prescription" and "History of Visits" buttons are active and have functionality. The other two buttons are a matter of further development.

### ---------------------------------

#### History of Visits

On this page the doctor can see the appointment history of a patient, no matter wheter upcoming or past. The upcoming visits are highlighted in green, and the past - in red.

### ---------------------------------

#### Add Prescription

Doctors can add prescriptions for their patients. They can add up to 30 medications and set their dosage and how many times a day should the patient take them, and for how long. To add new medication, they should simply click on the "Add another medication" button. By clicking "Submit", a new prescription is added to the database, and all of the medications are added to the same prescription. There are a few medications in the database, but more can be added in the "medications" table in of the database.

### ---------------------------------

#### Prescription Overview

After a doctor has added a prescription, they can see an overview of that prescription. It can be downloaded as .csv file.

### ---------------------------------

#### Patients List

Doctors can see a list of all of their patients ever. To be in this list, a patient should has had an appointment with this doctor at least once. On the same page, there are also "Info" buttons, which lead to the page with the information about the patient.

### ------------------------------------------------------------------------------------------------------------------

## The database

I used the table "user" to store the presonal and login information of each user (both patients and doctors). I also made two tables - "doctor" and "patient", which store only the id of the user, depending on whether the "role column" in the "user" table is set to patient or doctor. Because of security reasons, I used the md5 hash generator to encode the passwords of the users.

In the database there are some tables that are empty and are not a part of the project. The project is a matter or further development and these tables will come to use.
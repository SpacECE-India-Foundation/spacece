# SpaceCE Application Setup

Welcome to the SpaceCE project! This guide will walk you through the steps needed to set up and run the application on your local machine.

## Prerequisites

Before you begin, ensure you have the following installed on your system:
- **XAMPP**: A free and open-source cross-platform web server solution stack package.
- **MySQL**: A relational database management system.

## Setup Instructions

### 1. Clone the Repository

1. Open Git Bash.
2. Navigate to the `htdocs` directory of your XAMPP installation. This is usually located at:C:\xampp\htdocs
3. Clone the repository using the following command:
```bash
git clone https://github.com/SpacECE-India-Foundation/spacece.git
```
4. Change to the spacece directory: 
```bash
cd spacece
```

### 2. Checkout the Specific Branch

Ensure you are in the spacece directory.
Run the following command to switch to the Harshul-Varshney-bugfix branch:
```bash
git checkout Harshul-Varshney-bugfix
```
### 3. Start XAMPP Services

Open the XAMPP Control Panel.
Start both Apache and MySQL services by clicking the "Start" buttons next to each service.

### 4. Access the Application

Open Google Chrome (or any other web browser).
Enter the following URL in the address bar:
http://localhost/spacece

### 5. Set Up the Database

1. Open Google Chrome and go to phpMyAdmin by entering:
http://localhost/phpmyadmin

2. Create Databases:
In phpMyAdmin, click on the Databases tab.
Create a new database for each SQL dump file provided. Use a relevant name for each database.

3. Import SQL Dumps:
Select the newly created database from the left sidebar.
Click on the Import tab.
Click Choose File and select the SQL dump file.
Click Go to start the import process.
Repeat this step for each SQL dump file.

4. Troubleshooting
Application Not Loading: Ensure both Apache and MySQL services are running.
Database Connection Issues: Double-check the database names and import process.

pipeline {
    agent any

    stages {
        stage('Checkout') {
            steps {
                // Clone the repository
                git 'https://github.com/Aditiniphade/ansibleb2.git'
            }
        }

        stage('Build') {
            steps {
                // Run a Maven build
                sh 'mvn clean install'
            }
        }

        stage('Test') {
            steps {
                // Run tests
                sh 'mvn test'
            }
        }
    }

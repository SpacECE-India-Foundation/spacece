// pipeline{
//     agent any
//     environment{
//         staging_server="44.203.29.146"
//     }
//     stages{
//         stage('Deploy to Remote Server'){
//             steps{
//                 sh 'scp -r ${WORKSPACE} root@${staging_server}:/var/www/html/spaceece-main/'
//             }
//         }
//     }
// }

pipeline {
    agent any

    environment {
        staging_server = "44.203.29.146"
    }

    stages {
        stage('Build') {
            steps {
                echo 'Building...'
            }
        }
        stage('Test') {
            steps {
                echo 'Testing...'
            }
        }
        stage('Deploy to Remote Server') {
            steps {
                sh 'scp -r ${WORKSPACE} root@${staging_server}:/var/www/html/spaceece-main/'
            }
        }
    }
}

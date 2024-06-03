pipeline{
    agent any
    environment{
        staging_server="44.203.29.146"
    }
    stages{
        stage('Deploy to Remote'){
            steps{
                sh 'scp -r ${WORKSPACE} root@${staging_server}:/var/www/html/spaceece-main/'
            }
        }
    }
}

pipeline{
    agent any
    environment{
        staging_server="172.31.4.224"
    }
    stages{
        stage('Deploy to Remote'){
            steps{
                sh 'scp -r ${WORKSPACE} root@${staging_server}:/var/www/html/spaceece-main/'
            }
        }
    }
}

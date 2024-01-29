pipeline {
    agent any 
    stages {
        stage('Test') {
            steps {
                echo 'Hello World'
            }
        }
        stage('SonarQube') {
           steps {
                script { scannerHome = tool 'SonarQube Scanner' }
                withSonarQubeEnv('SonarQube') {
                    sh "${scannerHome}/bin/sonar-scanner -Dsonar.projectKey=OWS-opdrachten"
                }
            }
        }
    }
}

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
                sh "${scannerHome}/bin/sonar-scanner
                    -Dsonar.projectKey=[OWS-opdrachten]"
            }
         }

    }
    post {
        always {
            echo 'Jenkins run!'
        }
        success {
            echo 'Tests succes!'
        }
        failure {
            echo 'tests failed!'
        }

    }
}

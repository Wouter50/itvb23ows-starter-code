pipeline {
    agent any 
    stages {
        stage('Test') {
            steps {
                echo 'Hello World'
            }
        }
    }
    post {
        always {
            echo 'Jenkins run!'
        }
        succes {
            echo 'Tests succes!'
        }
        failure {
            echo 'tests failed!'
        }

    }
}

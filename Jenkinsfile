pipeline {
    agent any

    environment {
        DOCKER_IMAGE = "laravel-app"
        K8S_CLUSTER = "local-k8s-cluster"
        TF_DIR = "terraform"
    }

    stages {
        stage('Checkout') {
            steps {
                checkout scm
            }
        }

        stage('Build Docker Image') {
            steps {
                script {
                    def commitHash = sh(script: 'git rev-parse --short HEAD', returnStdout: true).trim()
                    def imageTag = "$DOCKER_IMAGE:$commitHash"
                    sh "docker build -t $imageTag ."
                }
            }
        }

        stage('Run Security Scan') {
            steps {
                script {
                    sh "trivy image --format json --output trivy-report.json $DOCKER_IMAGE"
                    archiveArtifacts artifacts: 'trivy-report.json', allowEmptyArchive: true
                }
            }
        }

        stage('Provision Infrastructure') {
            steps {
                script {
                    dir(TF_DIR) {
                        sh 'terraform validate'
                        sh 'terraform plan -out=tfplan'
                        sh 'terraform apply -auto-approve tfplan'
                    }
                }
            }
        }

        stage('Get Terraform Outputs') {
            steps {
                script {
                    def laravelAppUrl = sh(script: 'terraform output -raw laravel_app_url', returnStdout: true).trim()
                    def phpmyadminUrl = sh(script: 'terraform output -raw phpmyadmin_url', returnStdout: true).trim()
                    echo "Laravel App URL: ${laravelAppUrl}"
                    echo "phpMyAdmin URL: ${phpmyadminUrl}"
                }
            }
        }

        stage('Deploy to Kubernetes') {
            steps {
                script {
                    sh 'kubectl apply -f k8s/deployment.yaml'
                    sh 'kubectl apply -f k8s/service.yaml'
                    sh 'kubectl apply -f k8s/phpmyadmin-service.yaml'
                    sh 'kubectl apply -f k8s/rbac.yaml'
                    sh 'kubectl apply -f k8s/network-policy.yaml'
                    sh 'kubectl wait --for=condition=available --timeout=600s deployment/laravel-app'
                }
            }
        }

        stage('Post-Deployment Tests') {
            steps {
                script {
                    sh 'kubectl port-forward svc/laravel-app-service 8000:80 &'
                    sh 'curl http://localhost:8000'  // Tester l'API une fois le port-forward établi
                }
            }
        }
    }

    post {
        success {
            echo 'Déploiement réussi !'
        }
        failure {
            echo 'Échec du déploiement.'
        }
    }
}

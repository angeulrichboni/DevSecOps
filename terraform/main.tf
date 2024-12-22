provider "docker" {
  host = "unix:///var/run/docker.sock"
}

resource "docker_network" "internal_network" {
  name = "internal_network"
}

resource "docker_image" "laravel_app" {
  name = "laravel-app"
  build {
    context    = "./"
    dockerfile = "Dockerfile"
  }
}

resource "docker_container" "laravel_app" {
  name  = "laravel-app"
  image = docker_image.laravel_app.latest
  ports {
    internal = 80
    external = 8000
  }
  networks_advanced {
    name = docker_network.internal_network.name
  }
}

resource "docker_container" "mysql" {
  name  = "dbmysql"
  image = "mysql:8.0"
  environment = {
    MYSQL_ROOT_PASSWORD = "Admin@1234"
    MYSQL_DATABASE      = "TaskListDB"
    MYSQL_USER          = "devuser"
    MYSQL_PASSWORD      = "Dev@Test@1234"
  }
  networks_advanced {
    name = docker_network.internal_network.name
  }
}

resource "docker_container" "phpmyadmin" {
  name  = "phpmyadmin_db"
  image = "phpmyadmin:latest"
  ports {
    internal = 80
    external = 8080
  }
  networks_advanced {
    name = docker_network.internal_network.name
  }
}

output "laravel_app_url" {
  value = "http://localhost:30001"  # Port NodePort pour Laravel
}

output "phpmyadmin_url" {
  value = "http://localhost:30002"  # Port NodePort pour phpMyAdmin
}

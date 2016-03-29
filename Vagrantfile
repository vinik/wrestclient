ENV['VAGRANT_DEFAULT_PROVIDER'] = 'docker'

VAGRANTFILE_API_VERSION = "2"

CURRENT_DIR = Dir.pwd

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|

  # config.vm.box = 'vinik/ubuntu'

  config.vm.define "db" do |db|
    db.vm.provider "docker" do |docker|
      docker.name = "wrestclient_db"
      docker.image = "mysql"
      docker.remains_running = true
      docker.ports = [ "3306:3306" ]
      docker.expose = [ 3306 ]
      docker.env = {
        "MYSQL_ROOT_PASSWORD" => "changeme"
      }
      docker.cmd = ["mysqld"]
    end

    db.vm.provision "shell", inline: "echo hello"
  end

  config.vm.define "web" do |web|
    web.vm.provider "docker" do |docker|
      docker.name = "wrestclient_web"
      # docker.build_dir = "."
      docker.image = "vinik/web"
      docker.cmd = ["apachectl", "-D", "FOREGROUND"]
      docker.ports = [ "80:80" ]
      docker.privileged = true
      docker.link 'wrestclient_db:wrestclient_db'
      docker.volumes = [
        CURRENT_DIR + ":/var/www/html",
        "/tmp" + ":/var/www/html/app/tmp"
      ]
      docker.env = {
        'MYSQL_DB_HOST' => 'wrestclient_db',
        'MYSQL_DB_PORT' => 3306,
        'MYSQL_DB_USERNAME' => 'root',
        'MYSQL_DB_PASSWORD' => 'changeme',
        'MYSQL_DB_DATABASE' => 'wrestclient'
      }
    end

    web.vm.provider "virtualbox" do |virtualbox|
      virtualbox.name = "aws_jumpstart"
      virtualbox.memory = 512
      config.vm.synced_folder CURRENT_DIR, "/workspace"
    end

    web.vm.provision "shell", inline: "echo 'foo'"

  end

end

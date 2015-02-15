# Set the site name
site_name = "xxx"

Vagrant.configure(2) do |config|
  config.vm.box = "smallhadroncollider/ubuntu-14.04-nginx-php55-mysql"
  config.vm.box_version = "0.2"

  config.vm.network "private_network", ip: "172.31.254.245"
  config.vm.hostname = "#{site_name}.dev"
  config.hostsupdater.aliases = ["www.#{site_name}.dev"]

  config.vm.synced_folder "./", "/var/www"

  config.vm.provision "shell", path: "provision.sh"

  config.vm.provider :virtualbox do |virtualbox|
    virtualbox.name = site_name
    virtualbox.memory = 512
    virtualbox.cpus = 1
    virtualbox.customize ["modifyvm", :id, "--natdnshostresolver1", "on"]
  end
end

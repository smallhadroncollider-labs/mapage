# Set the site name
site_name = "mapage"

Vagrant.configure(2) do |config|
  config.vm.box = "smallhadroncollider/ubuntu-14.04-nginx-php55-mysql"
  config.vm.box_version = "0.2"

  # Setup the dev domain name
  config.vm.network "private_network", ip: "172.31.254.245"
  config.vm.hostname = "#{site_name}.dev"
  config.hostsupdater.aliases = ["www.#{site_name}.dev"]

  # Setup the server root
  config.vm.synced_folder "./", "/var/www"

  # Add provisioning
  config.vm.provision "shell", path: "provision.sh"

  # Configure VirtualBox
  config.vm.provider :virtualbox do |virtualbox|
    virtualbox.name = site_name
    virtualbox.memory = 512
    virtualbox.cpus = 1
    virtualbox.customize ["modifyvm", :id, "--natdnshostresolver1", "on"]
  end
end

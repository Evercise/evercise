# -*- mode: ruby -*-
# vi: set ft=ruby :

# Vagrantfile API/syntax version. Don't touch unless you know what you're doing!
VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|

	config.vm.box = "Cod3"

    # The url from where the 'config.vm.box' box will be fetched if it
    # doesn't already exist on the user's system.
    # config.vm.box_url = "https://github.com/2creatives/vagrant-centos/releases/download/v0.1.0/centos64-x86_64-20131030.box"
    config.vm.box_url = "http://files.evercise.com/Cod3.box"
    config.vm.provider "virtualbox" do |vb|
      vb.customize ["modifyvm", :id, "--memory", "2048"]
      vb.customize ["modifyvm", :id, "--cpus", "1"]
      vb.customize ["modifyvm", :id, "--natdnsproxy1", "on"]
      vb.customize ["modifyvm", :id, "--natdnshostresolver1", "on"]
    end

    # Create a forwarded port mapping which allows access to a specific port
    # within the machine from a port on the host machine. In the example below,
	# accessing "localhost:8080" will access port 80 on the guest machine.
	config.vm.network :forwarded_port, guest: 80, host: 8080
	config.vm.network :forwarded_port, guest: 3306, host: 33060
	config.vm.network :forwarded_port, guest: 1080, host: 1080

    config.vm.provision :shell, :path => "server/install_server.sh"
    config.vm.provision :shell, run: "always", :path => "server/setup.sh"

    # Create a private network, which allows host-only access to the machine
  	# using a specific IP.
  	# config.vm.network :private_network, ip: "10.0.0.100", :netmask => "255.255.0.0"
  	config.vm.hostname = "dev.evercise.com"

	# Synced folders are configured below
	config.vm.synced_folder ".", "/var/www/html/", :owner => "apache", :group => "apache"

	#https://github.com/mitchellh/vagrant/issues/713#issuecomment-4416384
	config.vm.provider :virtualbox do |vb|
		# vb.customize ['setextradata', :id, 'VBoxInternal2/SharedFoldersEnableSymlinksCreate/v-root', '1' ]
  end

end
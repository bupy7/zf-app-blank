# Required plugins
# -----------------
# vagrant plugin install vagrant-vbguest
#
# Enviroment variables
# --------------------
# IP - IP-address of the application

VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
    config.vm.box = "debian/jessie64"
    config.vm.network "private_network", ip: ENV['IP'] || "192.168.20.22"
    config.vm.synced_folder ".", "/vagrant", type: "nfs"
    config.vm.provision "shell", path: "./workenv/bootstrap.sh"
    config.vm.provider "virtualbox" do |vb|
        vb.customize ["modifyvm", :id, "--memory", "512"]
        vb.name = "Zf-App-Blank - Debian Jessie 64"
    end
    config.vm.define "zf-app-blank" do |zab|
    end
end

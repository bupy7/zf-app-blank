# Required plugins
# -----------------
# vagrant plugin install vagrant-vbguest
# vagrant plugin install vagrant-hostmanager

require 'yaml'
require 'fileutils'

domains = {
    main: 'zf-app-blank.local',
}

config = {
    local: './workenv/config/vagrant-local.yml',
    dist: './workenv/config/vagrant-local.yml.dist'
}

# copy config from example if local config not exists
FileUtils.cp config[:dist], config[:local] unless File.exist?(config[:local])
# read config
options = YAML.load_file config[:local]

# check github token
if options['github_token'].nil? || options['github_token'].to_s.length != 40
    puts "You must place REAL GitHub token into configuration:\n/workenv/config/vagrant-local.yml"
    exit
end

# vagrant configurate
Vagrant.configure(2) do |config|
    # select the box
    config.vm.box = 'debian/jessie64'

    # should we ask about box updates?
    config.vm.box_check_update = options['box_check_update']

    config.vm.provider 'virtualbox' do |vb|
    # machine cpus count
        vb.cpus = options['server_cpus']
        # machine memory size
        vb.memory = options['server_memory']
        # machine name (for VirtualBox UI)
        vb.name = options['server_name']
     end

    # machine name (for vagrant console)
    config.vm.define options['server_name']

    # machine name (for guest machine console)
    config.vm.hostname = options['server_name']

    # network settings
    config.vm.network 'private_network', ip: options['ip']

    # sync: folder of project (host machine) -> folder '/vagrant' (guest machine)
    config.vm.synced_folder ".", "/vagrant", type: "nfs"

    # hosts settings (host machine)
    config.vm.provision :hostmanager
    config.hostmanager.enabled = true
    config.hostmanager.manage_host = true
    config.hostmanager.ignore_private_ip = false
    config.hostmanager.include_offline = true
    config.hostmanager.aliases = domains.values

    # provisioners
    config.vm.provision 'shell' do |s|
        s.path = './workenv/provision/once-as-root.sh'
        s.args = [
            options['server_time_zone'],
            options['mysql_db'],
            options['mysql_user'],
            options['mysql_pass'],
            options['php_time_zone'],
            options['php_memory_limit'],
            options['php_execution_time'],
            options['php_input_time'],
            options['server_locale'],
            options['pgsql_db'],
            options['pgsql_user'],
            options['pgsql_pass'],
            options['pgsql_locale'],
            options['db_type'],
            options['xdebug_idekey'],
            options['ip']
        ]
    end
    config.vm.provision 'shell' do |s|
        s.path = './workenv/provision/once-as-vagrant.sh'
        s.args = [options['github_token']]
        s.privileged = false
    end
    config.vm.provision 'shell', path: './workenv/provision/always-as-root.sh',
        run: 'always', args: [options['db_type']]

    # post-install message (vagrant console)
    config.vm.post_up_message = "Main URL: http://#{domains[:main]}"
end

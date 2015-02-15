# Laravel Boilerplate

## Changes

- Vagrant config
- Makefile config
- Compass config
- Sublime Text config
- Added [Whoops](https://github.com/filp/whoops)
- Added [Laravel Debugbar](https://github.com/barryvdh/laravel-debugbar)

## Details

### Vagrant
Vagrant should be installed on your system. It's also recommened that you install the `vbguest` and `hostsupdater` plugins:

```
vagrant plugin install vagrant-vbguest
vagrant plugin install vagrant-hostsupdater
```

You should edit the `db` and `password` variables in the `provision.sh` file and the `site_name` variable in the `Vagrantfile` before running `vagrant up`

### Makefile

- You should run `npm install` before running `make`
- You can run `sh watch` from the root directory to keep `make watch` running
- Uses `terminal-notifier` and `chrome-cli`

```
brew install terminal-notifier chrome-cli
```

### Compass

- Install Bundler `gem install bundler`
- Run `bundle install` from the root to install Compass
- Use `sh watch` to keep CSS files up to date

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)

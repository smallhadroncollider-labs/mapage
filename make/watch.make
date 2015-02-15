.PHONY: watch

watch: $(dev_css)

$(dev_css): $(dev_scss)
	@ compass compile && terminal-notifier -message "Compass Compiled" -title "Compass" -group temp && sleep 1 && terminal-notifier -remove temp
	@ touch $@
	@ chrome-canary-cli reload

.PHONY: build dirty before after push

build: before dirty after
dirty: $(refs)/app.ref $(build_www) $(refs)/vendor.ref $(build_css) $(build_js) $(build_img) $(build_fonts)

push:
	cd $(output) && git add -A && git commit -m "Latest build" && git push origin master

before:
	@ git stash > /dev/null
	@ printf "\nStashing uncommitted changes\n\n"

after:
	@ git stash pop > /dev/null
	@ printf "\nUnstashing uncommitted changes\n\n"

$(build_www): $(dev_www) $(refs)/app.ref
	@- mkdir $(build_public)
	@- cp $(dev_www) $(build_public)

$(build_css): $(dev_scss) $(css_replace)
	@- mkdir -p $(dir $@)
	@- cp $(css_replace) $(output)/$(css_replace)

	compass compile -e production --css-dir=$(dir $(build_css))
	@ cssshrink $@ > $(dir $@)main-shrunk.css && mv $(dir $@)main-shrunk.css $@

	@ hash=$$(hash.sh $@); \
		replace.sh "/css/main.css" "/css/$$hash.main.css" $(output)/$(css_replace)

$(build_img): $(dev_img)
	@- mkdir -p $(build_img)
	cp -R $(dev_img) $(build_img)

$(build_fonts): $(dev_fonts)
	@- mkdir -p $(build_fonts)
	cp -R $(dev_fonts) $(build_fonts)

$(refs)/app.ref: $(dev_app)
	@- mkdir $(output)
	@ touch $@
	rsync -R $? $(output)/

$(refs)/vendor.ref: composer.json
	@ touch $@
	- cp composer.json composer.lock $(output)

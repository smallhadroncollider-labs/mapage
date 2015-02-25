.PHONY: build dirty before after push

build: before dirty after
dirty: $(refs)/app.ref $(build_www) $(refs)/vendor.ref $(build_css) $(build_js) $(build_img) $(build_fonts)

push:
	cd $(output) && git add -A && git commit -m "Latest build" && git push origin master

before:
	@- git stash > /dev/null
	@ printf "\nStashing uncommitted changes\n\n"

after:
	@- git stash pop > /dev/null
	@ printf "\nUnstashing uncommitted changes\n\n"

$(build_www): $(dev_www) $(refs)/app.ref
	@- mkdir $(build_public)
	@- cp $(dev_www) $(build_public)

$(build_css): $(dev_scss) $(css_replace)
	@- mkdir -p $(dir $@)
	@- cp $(css_replace) $(output)/$(css_replace)
	@- rm $(build_css)

	compass compile -e production --css-dir=$(dir $@)
	@ cssshrink $(dir $@)main.css > $(dir $@)main-shrunk.css && mv $(dir $@)main-shrunk.css $(dir $@)main.css

	@ hash=$$(hash.sh $(dir $@)main.css); \
		replace.sh "/css/main.css" "/css/$$hash.main.css" "$(output)/$(css_replace)"

$(build_js): $(dev_js) build.js $(js_replace)
	@- mkdir -p $(dir $@)
	@- cp $(js_replace) $(output)/$(js_replace)
	@- rm $(build_js)

	r.js -o build.js out=$(dir $@)main.js

	@ replace.sh 'environment:"development"' 'environment:"staging"' "$(dir $@)main.js"

	@ hash=$$(hash.sh $(dir $@)main.js); \
		replace.sh "<script data-main=\"/js/load.js\" src=\"/vendor/requirejs/require.js\">" "<script src=\"/js/$$hash.main.js\">" "$(output)/$(js_replace)"

$(build_img): $(dev_img)
	@- mkdir -p $(build_img)
	cp -R $(dev_img) $(build_img)

$(build_fonts): $(dev_fonts)
	@- mkdir -p $(build_fonts)
	cp -R $(dev_fonts) $(build_fonts)

$(refs)/app.ref: $(dev_app)
	@- mkdir $(output)
	@ touch $@
	@ rm -rf $(output)/storage/debugbar
	rsync -R $? $(output)/

$(refs)/vendor.ref: composer.json
	@ touch $@
	- cp composer.json composer.lock $(output)

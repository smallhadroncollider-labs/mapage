####################
# Make directories #
####################
refs			:=		make/.refs

###########################
# Development directories #
###########################
dev_public		:=		public
dev_www			:=		$(shell find $(dev_public) -type f -depth 1 -not -path "*.DS_Store")
dev_scss		:=		$(shell find $(dev_public)/scss -name "*.scss")
dev_css			:=		$(dev_public)/css/main.css
dev_img			:=		$(shell find $(dev_public)/img -type f -not -path "*.DS_Store")
dev_fonts		:=		$(shell find $(dev_public)/fonts -not -path "*.DS_Store")

app_folders		:=		artisan app bootstrap config resources storage
dev_app			:=		$(shell find $(app_folders) -type f -not -path "*.DS_Store") $(shell find database -type f -path "*.php")

#####################
# Build directories #
#####################
output			:=		build
build_public	:=		$(output)/public

build_www		:=		$(build_public)
build_css		:=		$(build_public)/css/main.css
build_img		:=		$(build_public)/images
build_fonts		:=		$(build_public)/fonts
build_documents	:=		$(build_public)/documents

css_replace		:=		resources/views/app.blade.php

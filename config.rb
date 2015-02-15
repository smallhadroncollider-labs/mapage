require("sass-css-importer")
require("rgbapng")

# Set this to the root of your project when deployed:
environment = :development
relative_assets = true

http_path = "/"
css_dir = "public/css"
sass_dir = "public/scss"
images_dir = "public/img"
fonts_dir = "public/fonts"
javascripts_dir = "public/js"

add_import_path "public/vendor"

({
    logLevel: 2,

    baseUrl: "./public/js",

    // Use the almond RequireJS drop-in
    name: "../vendor/almond/almond",

    // Include the main JS file - otherwise only loads Almond
    include: ["load"],
    mainConfigFile: "public/js/load.js",

    // Output settings
    preserveLicenseComments: false,
    useStrict: true,
    optimize: "uglify2",
    urlArgs: null, // Turn off caching

    // Inline text templates
    inlineText: true,
    stubModules: ["text", "json"],

    // Required for Almond
    wrap: true
})

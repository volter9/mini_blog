#!/bin/sh
browserify index.js -o main.js
minify --output main.js main.js
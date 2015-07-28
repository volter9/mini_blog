#!/bin/sh
browserify index.js -o main.js --standalone mini_blog

if [ $# -ne 1 ]
then
    minify --output main.js main.js
fi
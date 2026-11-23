#!/bin/sh
# Build an installable theme zip: dist/skeleton-blog-<version>.zip
set -e
cd "$(dirname "$0")/.."
V=$(grep -m1 '^Version:' skeleton-blog/style.css | awk '{print $2}')
mkdir -p dist
rm -f "dist/skeleton-blog-$V.zip"
zip -rq "dist/skeleton-blog-$V.zip" skeleton-blog -x "*.DS_Store" -x "*/.git/*"
echo "built dist/skeleton-blog-$V.zip"

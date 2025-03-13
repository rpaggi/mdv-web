#!/bin/bash

git filter-branch --force --index-filter \
  "git rm --cached --ignore-unmatch frankenphp" \
  --prune-empty --tag-name-filter cat -- --all

git for-each-ref --format="delete %(refname)" refs/original | git update-ref --stdin
git reflog expire --expire=now --all
git gc --prune=now

git remote add github git@github.com:hisoft-br/mdv-web.git

for branch in $(git branch -r | grep -v "HEAD\|master" | sed 's/origin\///'); do
    echo "Migrando branch: $branch"
    git checkout $branch
    git push -f github $branch
done

git checkout master
git push -f github master

git push github --tags

git remote remove origin
git remote rename github origin


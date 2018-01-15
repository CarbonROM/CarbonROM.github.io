# CarbonROM


CarbonROM is an open-source ROM, and that being so, we rely on community contributions as well as contributions from our many team members.

# How to help with our site

In order to contribute to our website, you have to sign up for our [Gerrit] instance. Please note that we now only allow GPG signed commits to our Gerrit instance. You can [click here] to learn how to set it up. Once you've done that, you can clone the repo by using the following commands:
  - git clone ssh://YourGerritUsername@review.carbonrom.org:29418/CarbonROM/CarbonROM.github.io && scp -p -P 29418 YourGerritUserName@review.carbonrom.org:hooks/commit-msg CarbonROM.github.io/.git/hooks/
  - Make your changes to the repo.
  - git commit -a -S -m 'Your commit message.'
  - git push origin HEAD:refs/for/master


   [Gerrit]: <https://review.carbonrom.org>
   [click here]: <https://github.com/CarbonROM/android/blob/cr-5.1/README.md>

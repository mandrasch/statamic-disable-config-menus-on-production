# statamic-disable-config-menus-on-production

Quick & dirty experiment for Statamic CMS, work in progress

## Goal

In my perfect world important data structure or config changes are only done in local dev environments. These will be then commited to git and be deployed via Github Action (or similiar) to the production server(s). 

On production the admins and editors should not have the possibility to alter configs, data schemas, blueprints, etc.

I use [DDEV](https://ddev.com/) for local development, therefore I quickly check if the site runs on ".ddev.site" (local dev) or something else = production. If the admins visit a forbidden route on a production site, there is an error message. Of course it would be better if admin wouldn't see the "edit blueprint/collection"-button or link in the first place ;-)

See here for more infos about DDEV & statamic: https://my-ddev-lab.mandrasch.eu/tutorials/cms-and-frameworks/statamic.html

## Installation

put the folder `mandrasch/` into /addons/ and add this to composer.json like described here https://statamic.dev/extending/addons#private-addons.

```
    "mandrasch/disable-config-menus-on-production": "dev-main",
```

Disclaimer: I'm a Statamic newbie.

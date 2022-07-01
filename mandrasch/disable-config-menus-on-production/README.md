# Disable Config Menus On Production

> Disable Config Menus On Production is a Statamic addon which separated config from content.

## Features

This addon prevents super admins from changing the config on the live server. If you want a clean separation of content and config, configuration changes should be only made in local dev environments and be commited from there via git (Github Actions).

(Do not use this addon if you use Git automation on your live server. This would be pointless ;-))

## How to Install

You can search for this addon in the `Tools > Addons` section of the Statamic control panel and click **install**, or run the following command from your project root:

```bash
composer require mandrasch/hide-config-menus-on-production
```

## How to Use

Here's where you can explain how to use this wonderful addon.

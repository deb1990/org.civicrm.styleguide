# CiviCRsdfdsM Style Guide (org.civicrm.styleguide)

Demonstrate common HTMTL/CSS styling conventions used within CiviCRM.

This extension adds a new submenu, "Support => Developer => Style Guides"
with a list of demo pages.

## Installation (WIP)

> These steps are subject to change.

```
mkdir sites/all/modules/civicrm/ext
cd sites/all/modules/civicrm/ext
git clone https://github.com/civicrm/org.civicrm.shoreditch shoreditch
git clone https://github.com/civicrm/org.civicrm.styleguide styleguide
cv en shoreditch styleguide
```

## Creating Additional Style Guides

If you write an extension with a distinctive set of HTML/CSS conventions,
then you can create additional guides. This requires a small hook and some HTML files.

Suppose your extension is `org.example.myextension`; the hook might look like:

```php
function myextension_civicrm_styleGuides($styleGuides) {
  $styleGuides->add(array(
    'name' => 'my-guide',
    'label' => ts('My Guide'),
    'path' => Civi::resources()->getPath('org.example.myextension') . '/guide',
  ));
}
```

Then, in the source tree for `org.example.myextension`, create a set of folders
to store the HTML snippets:

```
cd /path/to/org.example.myextension
mkdir guide guide/docs  guide/foundation
mkdir guide/markup{,/base,/patterns}
mkdir guide/usage{,/base/patterns}
```

and create your first HTML snippet:

```
<!-- FILE: guide/docs/about.html -->
<p>This is the new style guide for my extension, org.example.myextension</p>
```

and navigate to ""Support => Developer => Style Guides => My Guide"

## Tests

### BackstopJS
This extension uses [BackstopJS](https://github.com/garris/BackstopJS) to detect visual changes on the styleguide.

This tool should be used for example when working on a CiviCRM theme like [shoreditch](https://github.com/civicrm/org.civicrm.shoreditch), to make sure that no regression issues or unintended changes are accidentally introduced

To use BackstopJS first install the node packages
```
npm install
```
and then tell BackstopJS to take the reference screenshots
```
gulp backstopjs:reference
```
Once you are done with your changes, you can take the same screenshots again that will then be compared by the tool to spot visual differences
```
gulp backstopjs:test
```
If the visual difference are ok, you can tell BackstopJS to approve them, so that they will be used as the reference from that point forward
```
gulp backstopjs:approve
```
If you need to reopen the last html report, simply run
```
gulp backstop:report
```

### Protractor
The browser-level integration tests are implemented with `protractor` and stored
under `tests/protractor/`.  (If you have not already installed Protractor, then
follow [the setup instructions from `protractortest.org`](http://www.protractortest.org/).)

Then run:

```
cd org.civicrm.styleguide
protractor tests/protractor/conf.js
```

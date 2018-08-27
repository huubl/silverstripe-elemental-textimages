# SilverStripe Elemental Text-Images Block

A block that displays content with one or multiple Images.  
(private project, no help/support provided)

## Requirements

* SilverStripe ^4.2
* dnadesign/silverstripe-elemental ^3.0
* sheadawson/silverstripe-linkable ^2.0@dev
* jonom/focuspoint ^3.0
* bummzack/sortablefile ^2.0

## Suggestions
* derralf/elemental-styling

**Important**:

In the templates I use`<% include Derralf\\Elements\\ElementTitleStyled %>`

If you don't install/use the Module derralf/elemental-styling you have to add `Derralf/Elements/Includes/ElementTitleStyled.ss` to your Templates yourself or use your own templates.

Example:  
```
<h2 class="element__title maybe_some_other_class">$Title</h2>
```


## Installation

- Install a module via Composer
  ```
  composer require derralf/silverstripe-elemental-textimages
  ```


### Template Notes

Templates based on Bootstrap 3+

- Optionaly, you can require basic CSS stylings provided with this module to your controller class like:
  **mysite/code/PageController.php**
  ```
      Requirements::css('derralf/elemental-textimages:client/dist/styles/frontend-default.css');
  ```
  or copy over and modify `client/src/styles/frontend-default.scss` in your theme scss

- Images wrapped in link tags (optimized / with some data-attributes for [lightgallery](http://sachinchoolur.github.io/lightGallery/))   
  Optionally you can require a basic default javascript (requires jQuery) and (if not already included in your theme) lightgallery (respect license!)
  ```
  Requirements::javascript('https://cdn.jsdelivr.net/npm/lightgallery@1.6.11/dist/js/lightgallery-all.js');
  Requirements::css('https://cdn.jsdelivr.net/npm/lightgallery@1.6.11/dist/css/lightgallery.min.css');
  Requirements::javascript('derralf/elemental-textimages: client/dist/js/lightgallery.init.js');
  ```
  ...or use any other lightbox script...

- data-attributes in Image Links  
  2 data-attributes are supplied in the templates:
  - `data-sub-html="$Legend.ATT"` to optinally provide a caption for lightgallery
  - `data-exthumbimage="$Me.Fill(96,76).Link"` to provide an thumbnail for lightgallery
  
  You may want to extend Image class with a "getLegend()" method or suitable db field
  

## Configuration

The Basic/default config:

```
Derralf\Elements\TextImages\Element\ElementTextImages:
  styles:
    '': "Standard (kein Bild beim Text)"
    OneRightFiftyFifty: "Bild rechts, 50%"
    OneLeftFiftyFifty: "Bild links, 50%"
    OneRight: "Bild rechts, 33%"
    OneLeft: "Bild links, 33%"
    OneTop: "Bild oben"
    OneTop3by1: "Bild oben, Format 3:1"
  image_view_modes:
      '': "keine weiteren Bilder unter dem Text anzeigen"
      HiddenGallery: "versteckte Galerie"
      TwoBelow: "2 weitere Bilder unten, quer"
      TwoBelowSquare: "2 weitere Bilder unten, quadratisch"
      ThreeBelow: "3 weitere Bilder unten"
      FourBelow: "4 weitere Bilder unten (4 Spalten)"
      AllBelow3Cols: "alle weiteren Bilder unten (3 Spalten)"
  defaults:
    ImageViewMode: 'TwoBelow'
  readmore_link_class: 'btn btn-primary btn-readmore'
```


#### Add Templates to the config maps in **mysite/\_config/mysite.yml**:
This adds a new Entry at the beginnig of the styles dropdown:

```
Derralf\Elements\TextImages\Element\ElementTextImages:
  styles:
    MyCustomTemplate: "new customized special Layout"
```

...and put a template named `ElementTextImages_MyCustomTemplate.ss`in `themes/{your_theme}/templates/Derralf/Elements/TextImages/Element/`


#### Rename Titles of the config maps in **mysite/\_config/mysite.yml**:
This renames an existing Entry and adds a new Entry at the end of the styles dropdown:

```

---
After: elementaltextimages
---
Derralf\Elements\TextImages\Element\ElementTextImages:
  styles:
    OneRightFiftyFifty: "your new Title goes here"
    MyCustomTemplate: "new customized special Layout"
```


##### Delete all Templates in **mysite/\_config/mysite.yml**:
Removing all default styles from the styles dropdown will disable it:

```

---
After: elementaltextimages
---
Derralf\Elements\TextImages\Element\ElementTextImages:
  styles: null
---
```

##### Delete/reset Templates and add your own in **mysite/\_config/mysite.yml**:
If you want only your own templates available in the styles dropdown you have to reset the whole styles dropdown (remove all of my default styles/templates) and afterwards add your own styles like this:

```

---
Name: resetelementaltextimages
After: elementaltextimages
---
Derralf\Elements\TextImages\Element\ElementTextImages:
  styles: null
---
After: resetelementaltextimages
---
Derralf\Elements\TextImages\Element\ElementTextImages:
  styles:
    '': "default (No image next to text)"
    StyleOne: 'One style'
    StyleTwo: 'Other Style'
---
```

...and put your template in the appropriate folders.


## Screen Shots

(not available)



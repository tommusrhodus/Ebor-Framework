Ebor-Framework
==============

Ebor Framework - The Driving Force Behind TommusRhodus' Themes
Custom post types, meta boxes etc.

### Custom Post Type Filters

All custom post type calls can be filtered, for example, each CPT runs this on its register:

`apply_filters( 'ebor_cpt_init', $args, "client")`

So you can go ahead and add_filter to change any of the $args as required.

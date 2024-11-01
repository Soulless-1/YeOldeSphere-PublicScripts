these only exist for backwards compatibility, mostly with npcs that are wearing any colored armor

the better way to do colored armor or magic items is to create a base item, then modify it : 
color=<color_o_ingotcolor>
name=<ingotname> <name>
modar += <ingotbonus>

creating one itemdef for every type of ingot/magic armor will result in hundreds even thousands of itemdefs.
especially when it comes to the magic item variations [massive/ruin/vanq]. there are many combinations and that would need to be accounted for
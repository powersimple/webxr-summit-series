function megaMenu() {
    var classes = ''
    var megamenu = '<nav id="megamenu" class="content">'
    megamenu += '<ul class="exo-menu">';

    megamenu += getMegaMenu(menus.megamenu.menu_levels, classes);

    megamenu += '<a href="#" class="toggle-menu visible-xs-block"><i class="fa fa-bars"></i></a>'


    megamenu += '</ul></nav>'
        //console.log("megamenu=", megamenu)
    jQuery("#main-menu").html(megamenu);
}

function getMegaMenu(items, parent_classes) {
    //console.log(items, parent_classes)

    var this_item = 0,
        menu_items = '',
        classes = '',
        ulclass = '',
        headwrap = '',
        footwrap = '',
        link = "#",
        outer = 'li',
        level = 0,
        target = ''
    for (var i = 0; i < items.length; i++) {

        this_item = items[i]
        headwrap = ''
        footwrap = ''
        classes = ''
        link = ''
        outer = 'li'

        if (this_item.classes != '') {
            classes = ' class="' + this_item.classes + '"'
            ulclass = this_item.classes + '-ul'

        }
    

        if (this_item.classes != undefined) {
            if (this_item.classes.indexOf('mega-drop-down')) {
                //      console.log(this_item.title, "mega")

                headwrap = '<div class="animated fadeIn mega-menu">'
                headwrap += '<div class="mega-menu-wrap">'
                headwrap += '<div class="row">'
                headwrap = '<ul class="' + ulclass + ' animated fadeIn">'
                footwrap = '</ul></div></div></div>'

            } else if (this_item.classes.indexOf('drop-down')) {

                headwrap = '<ul class="' + ulclass + ' animated fadeIn">'
                footwrap = '</ul>'


            } else {
                headwrap = '<ul class="' + ulclass + ' animated fadeIn">'
                footwrap = '</ul>'
            }
            if (this_item.parent_classes == 'mega-drop-down') {
                outer = 'div'
            }
            if (this_item.object == 'gradelevel') {
                //   console.log("obj", this_item)
            }
           
            switch (this_item.object) {
                case "feature":
                    link = this_item.url
                    break
                case "category":
                    link = this_item.url
                    break
                case "industry":
                    link = this_item.url
                    break
                case "custom":
                    link = this_item.url

                    break

                case "conference":
                    link = this_item.url
                    break
                case "award":
                    link = this_item.url
                    break

                    // default: link = '#';
            }
            //    console.log(this_item)
            if(this_item.xfn != ''){
                this_item.url += '#'+this_item.xfn
                link += '#'+this_item.xfn
            }
            if (this_item.url == '') {
                //menu_items += '<' + outer + ' ' + classes + '><span>' + this_item.title + '</span>' this needs to open the dropdown
                if (this_item.target != '') {
                    target = 'target="_blank"'
                }

                menu_items += '<' + outer + ' ' + classes + '><a href="' + link + '"' + target + '>' + this_item.title + '</a>'
            } else {
                menu_items += '<' + outer + ' ' + classes + '><a href="' + this_item.url + '">' + this_item.title + '</a>'
            }

            if (this_item.children != undefined) {

                if (this_item.children.length > 0) {
                    menu_items += headwrap
                        //     console.log("wrap",headwrap,footwrap)
                    menu_items += getMegaMenu(this_item.children, this_item.classes)

                    menu_items += footwrap

                }
            }
            menu_items += '</li>'
        }

    }

    return menu_items;
}
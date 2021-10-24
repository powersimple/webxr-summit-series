var menu_config = {
    'megamenu': {
        'menu_type': 'megamenu',
        'location': '#main-menu'
    },
    'sponsor-footer': {
        'menu_type': 'profile',
        'location': '#sponsor-footer'
    },
    'social-links': {
        'menu_type': 'social',
        'location': '#social'
    },
    'bizsummit21': {
        'menu_type': 'run-of-show',
        'location': '#run-of-show'

    },
    'designsummit21': {
        'menu_type': 'run-of-show',
        'location': '#run-of-show'

    },
    'devsummit21': {
        'menu_type': 'run-of-show',
        'location': '#run-of-show'

    }
}
function runOfShow(id){
    console.log("run of show"+id)
       console.log(menus[id])
    var show = menus[id]
    for (var i = 0; i < show.length; i++) {
        show[show[i].slug] = {}

    }
    console.log(show)



}



function setMenus(data) {
    //console.log("raw menu data",data)

    for (var i = 0; i < data.length; i++) {
        menus[data[i].slug] = {}
        menus[data[i].slug].menu_array = []
        menus[data[i].slug].menu_levels = []
        menus[data[i].slug].name = data[i].name
        menus[data[i].slug].slug = data[i].slug
        menus[data[i].slug].items = setMenu(data[i].slug, data[i].items)

        //console.log("slug", data[i].slug)
    }
    buildMenuData();
       //console.log("raw menu data", menus)

}

function setMenu(slug, items) {
    menu = {}
        //console.log("setMenu",dest,slug,items)
    for (var i = 0; i < items.length; i++) {
        menu[items[i].ID] = setMenuItem(slug, items[i])
            // console.log("setMenu", items[i].ID, slug, items)
        if (items[i].menu_item_parent != 0) { //recursive
            menu[items[i].menu_item_parent].children.push(items[i].ID) //children empty array is created in setMenuItem

        } else {
        }
        menus[slug].menu_array.push(menu[items[i].ID])

    }
    // console.log("MENU ARRAY",menus[dest].menu_array)
    // console.log("SetMenu", slug, menu)
    return menu
}

function setMenuItem(slug, item) {
    //console.log("setMenuItem",item)
    this_item = {}
    this_item.menu_id = item.ID
    this_item.title = item.title

    this_item.menu_order = item.menu_order
    this_item.object = item.object
    this_item.object_id = item.object_id
    this_item.parent = item.menu_item_parent
    this_item.classes = item.classes
    this_item.url = item.url
    this_item.description = item.description
    this_item.slug = slug
    this_item.xfn = item.xfn



    this_item.children = [] //this array is populated in Set Menu

    return this_item
}

jQuery(document).ready(function() {
    if ( $.isFunction(window.localTrigger) ) {
        localTrigger();
        console.log("triggered")
    } else {
        console.log("not triggered")
    }


});

function menu_order(a, b) {
    if (a.menu_order < b.menu_order)
        return -1;
    if (a.menu_order > b.menu_order)
        return 1;
    return 0;
}

function setLinearNav(m) {
    var counter = 0
    menus[m].linear_nav = [];
    var id = 0
    for (var i in menus[m].items) {


        // menu.items[i].post = posts[menu.items[i].object_id]
        menus[m].items[i].slug = i


        id = menus[m].items[i].object_id
        menus[m].linear_nav.push(menus[m].items[i])


        counter++;
    }
    menus[m].linear_nav.sort(menu_order);


    //console.log("linear_nav", menus[m].linear_nav);
    // console.log("posts_nav", posts_nav);

}

function setLinearDataNav(m, data) { // sets local data into linear array for wheel
    menus[m].data_nav = []
    menus[m].slug_nav = []
    var counter = 0,
        outer_counter = 0,
        inner_counter = 0,
        inner_subcounter = 0,
        grandparent = 0,
        next_parent = 0,
        dest = 'outer-nav'

    // THESE 3 NESTED LOOPS POPULATE THE data_nav array WITH WHAT IT NEEDS TO BUILD THE WHEEL AND HAVE IT BE CONTROLLED BY THE ORDERED NOTCHES FROM THE NAV
    //console.log(m,data)
    for (var d = 0; d < data.length; d++) { //outer
        dest = 'outer-nav'
        data[d].dest = dest;
        data[d].slice = outer_counter;
        data[d].notch = counter;
        grandparent = counter;
        menus[m].data_nav.push(data[d])
        menus[m].slug_nav[data[d].slug] = counter
        counter++;
        for (var c = 0; c < data[d].children.length; c++) { //children
            data[d].children[c].dest = "inner-nav"
            data[d].children[c].slice = c
            data[d].children[c].notch = counter
            data[d].children[c].parent = grandparent
            next_parent = counter
            menus[m].data_nav.push(data[d].children[c])
            menus[m].slug_nav[data[d].children[c].slug] = counter;
            counter++
            for (var g = 0; g < data[d].children[c].children.length; g++) { //grandchildren
                data[d].children[c].children[g].dest = "inner-subnav"
                data[d].children[c].children[g].slice = g
                data[d].children[c].children[g].notch = counter
                data[d].children[c].children[g].grandparent = grandparent
                data[d].children[c].children[g].parent = next_parent

                menus[m].data_nav.push(data[d].children[c].children[g])
                menus[m].slug_nav[data[d].children[c].children[g].slug] = counter;
                counter++
            }
            // console.log("dataNav", data);
        }

        outer_counter++;

    }
    //console.log("dataNav",m, menus[m].data_nav);
    //console.log("slug_nav",m, menus[m].slug_nav);
}

function getSlug(item, _of, _array, _it) {
    var slug = ''
    if (item != undefined) {
        slug = item.slug
        if (posts[item.object_id] != undefined) {
            slug = posts[item.object_id].slug
        }
    } else {
        //  console.log("get slug item undefined",slug,item.object_id,item,_of,_array,_it)
    }
    return slug

}

function buildMenuData() {

    // needs post variable
    if (posts == undefined) {
        //console.log("No Posts Data Yet",  posts)
        window.setTimeout(buildMenuData(), 10);
    } else {




        for (var m in menus) { // 
            var data = [];
            //console.log('menu loop',m)
            if (menu_config[m] != undefined) {
                var items = ''

                //menus[m].items.sort(function(a,b){return a.menu_order-b.menu_order})



                menus[m].menu_array = [];
                for (var i in menus[m].items) {
                    // console.log('menu item', menus[m].items[i], menu_config[m].location)
                    if (menus[m].items[i].parent == 0) {
                        // console.log("menu", menus[m].items[i].title)

                        menus[m].menu_array.push(menus[m].items[i]);
                    }
                    // items += '<a href="#" class="">' + menus[m].items[i].title + '</a>'

                }
                menus[m].menu_array.sort(menu_order);


                var children = [];
                var this_menu = menus[m].menu_array
                var slug = ''
                for (var a = 0; a < this_menu.length; a++) {
                    children = [];

                    for (var c = 0; c < this_menu[a].children.length; c++) {
                        var grandchildren = [];
                        var nested_children = menus[m].items[this_menu[a].children[c]].children;
                        for (var g = 0; g < nested_children.length; g++) {
                            slug = getSlug(menus[m].items[nested_children[g]], g, "g", nested_children, g)
                            grandchildren.push( // data for childe menus
                                {
                                    "title": menus[m].items[nested_children[g]].title,
                                    "url": menus[m].items[nested_children[g]].url,
                                    "slug": slug,
                                    "object": menus[m].items[nested_children[g]].object,
                                    "object_id": menus[m].items[nested_children[g]].object_id, // the post id
                                    "classes": menus[m].items[nested_children[g]].classes,
                                    "description": menus[m].items[nested_children[g]].description,
                                    "description": menus[m].items[nested_children[g]].xfn,
                                    
                                }
                            )

                        }

                        slug = getSlug(menus[m].items[this_menu[a].children[c]], "c", this_menu[a].children[c], c)
                            //console.log('bad slug', menus[m].items[this_menu[a].children[c]])
                        children.push( // data for child menus
                            {
                                "title": menus[m].items[this_menu[a].children[c]].title,
                                "slug": slug,
                                "url": menus[m].items[this_menu[a].children[c]].url,
                                "object": menus[m].items[this_menu[a].children[c]].object,
                                "object_id": menus[m].items[this_menu[a].children[c]].object_id, // the post id
                                "classes": menus[m].items[this_menu[a].children[c]].classes,
                                "description": menus[m].items[this_menu[a].children[c]].description,
                                "xfn": menus[m].items[this_menu[a].children[c]].xfn,
                                
                                "children": grandchildren

                            }
                        )

                    }
                    //console.log('outer', this_menu[a].object_id,  this_menu[a])
                    slug = getSlug(this_menu[a], "o", this_menu, a)
                        //  console.log(this_menu[a])
                    data.push({ // data for top level
                        "title": this_menu[a].title,
                        //"id": this_menu[a].id,
                        "slug": slug,
                        "url": this_menu[a].url,
                        "object": this_menu[a].object,
                        "object_id": this_menu[a].object_id, //the post_id
                        "children": children,
                        "classes": this_menu[a].classes,
                        "description": this_menu[a].description,
                        "xfn": this_menu[a].xfn
                    })

                }
                menus[m].menu_levels = data
                console.log("menu level data",m,menus[m].menu_levels)

                menu_levels = data;
               
                setLinearDataNav(m, data);
                setLinearNav(m)
                    





                //circleMenu('.circle a')
            }

        }

    }

}
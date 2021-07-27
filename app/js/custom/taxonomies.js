function setChildCategories(data) {
    for (var i = 0; i < data.length; i++) {
        categories[data[i].id] = data[i]
    }
    // console.log('categories', categories)

    return data
}

function setCategories(data) {
    // console.log("categories json", data)
    if (data != null) {
        for (var i = 0; i < data.length; i++) { //creates object of categories by key
            categories[data[i].id] = data[i]
        }
    }
    //  console.log('categories', categories)

    return data
}

function setTaxonomy(data, tax) {
    taxonomies[tax] = {}
    if (data[tax] != null) {
        for (var i = 0; i < data[tax].length; i++) { //creates object of categories by key
            taxonomies[tax][data[tax][i].id] = data[tax][i]
        }
    }
    // console.log(tax, taxonomies[tax])

    return data
}

function setTags(data) {
    for (var i = 0; i < data.length; i++) {
        tags[data[i].id] = data[i]
    }
    //console.log('tags', tags)

    return data
}
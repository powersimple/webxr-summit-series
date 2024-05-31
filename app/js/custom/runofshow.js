
var ros_meta = {
    timezone: []
}
var currentROS = {}

function runOfShow(menu){
    console.log("runOfShow",menu)
    var show = menu.menu_levels;
 
        if(show.length != undefined){
        
        for (var s = 0; s < show.length; s++) {
            
            var this_event = show[s]
            this_event.sessions = [];
            this_event.info =events[show[s].object_id]
            for (var n = 0; n < show[s].children.length; n++) {   // sessions the children of shows
                session = show[s].children[n]
                session.info = events[show[s].children[n].object_id]
             
            //   session.info = events[show[s].children[n].object_id]
        

                session.profiles = []
            
                // session.info = events[show[s].sessions[n].object_id]
                for (var p = 0; p < show[s].children[n].children.length; p++) { // profiles

                
                    if(session.object=='profile'){ }
                        this_profile = show[s].children[n].children[p]
                
                        this_profile.profile = profiles[this_profile.object_id];
                        session.profiles.push(this_profile)
                    // console.log("profile",this_profile)
                
                
                }   
                this_event.sessions.push(session)
            this_event.sessions    
            }    
            


        }
        if(getUrlParameter('meta') == 'show'){
            displayMeta()

        }   


        return this_event
    }

}
function displayMeta(){
    var meta = ''
    for(m in ros_meta){
            meta+='<h4>'+m+'</h4>'
            console.log("meta",m,ros_meta[m])
        for(i=0;i<ros_meta[m].length;i++){
            meta+=ros_meta[m][i].id+'|'+ros[m][i].name+"<br>"

        }
    }
    $("#ros_meta").html(meta)

}
function adjustTimeZone(event_time,timezone){
    

    var time = timezone.split("| ")

    var offset = new Date()
    //console.log("Adjust",offset.getTimezoneOffset());
    var adjustment = offset.getTimezoneOffset()
    if(time[0]<0){
        adjustment = adjustment*-1
    }
    var adjust = ((parseInt(time[0])*60)*60)+adjustment; 

    var card = '<span class="timezone">'+convertDate(adjust)+'</span>'

    return card
}
function getProfileCard(this_profile){
    var title = ''
    var card = ''
    var credential = ''
    var social = ''

    var info = this_profile.profile.meta

    if(info != undefined){
        if(getUrlParameter('timezone') == 'show'){
            var timezone = this_profile.profile.meta.timezone[0]
            if(timezone != undefined){
            
              
                
               // card+= adjustTimeZone(event_time,timezone)
            } else{
              
                ros_meta.timezone.push({id:this_profile.object_id,name:this_profile.title})
            }
    
        }
       
        

        if(info.profile_title != undefined){
            credential +=  '<span>'+info.profile_title.trim()+", "+'</span>'
        }
        if(info.company != undefined){
            credential += '<span>'+info.company.trim()+'</span>'
        }
        if(info.twitter != undefined){
          credential += '<span>@'+info.twitter.replace("https://twitter.com/","")+'</span>'
        }
        if(credential != ''){
            card += '<span class="credential">'+credential+'</span>'
        }
        
        if(!hide_social_icons){
            if(info.twitter != undefined){
                social +='<a target="_new" class="twitter" href="'+info.twitter+'"><i class="fa fa-x-twitter social-icon" title="'+this_profile.title+' on Twitter"></i></a>'
            }
            if(info.linkedin != undefined){
                social +='<a target="_new" class="linkedin" href="'+info.linkedin+'"><i class="fa fa-linkedin social-icon" title="'+this_profile.title+' on LinkedIn"></i></a>'
            }
            if(info.github != undefined){
                social +='<a target="_new" class="github" href="'+info.github+'"><i class="fa fa-github social-icon" title="'+this_profile.title+' on GitHub"></i></a>'
            }
        }
        if(social != ''){

            card+='<span class="social">'+social+'</span>'
        }
       
        return card;
    } else {
     //   console.log("no profile info",this_profile)
    }
    

  
    



    
} 
function displayRunOfShowList(runOfShow){
    var list = '<div class="ros-list">'
  
    var now = new Date()
    var showtime = null
    if(runOfShow.info.event_info.utc_start != undefined){
        showtime = runOfShow.info.event_info.utc_start;
    }
    
    var duration = 0;
    var tense = "future";
    var seconds =  Math.floor(Date.now() / 1000)
    if(seconds>showtime){
        tense = "past"
    }
    var event_date = new Date(parseInt(showtime))
  //  console.log(event_date)
    var session;
    var this_profile;
    var info = {};
    var credential; 
    var session_number = 0;
    var session_order;
    var description;
    var display_event_time
    var admin = getUrlParameter('admin')
    var session_ids = {}

    list += '<h2|'+runOfShow.title+'</h2>'
//    list += '<h2>'+runOfShow.title+'</h2>'
    
    //list +=  event_date

    for (var n = 0; n < runOfShow.sessions.length; n++) { 
        session = runOfShow.sessions[n];
        session_order = session_number
        if(session_number<10){
            session_order = '0'+session_number
        }
        if(runOfShow.sessions[n].info.event_info.duration == undefined){
            runOfShow.sessions[n].info.event_info.duration = 0
        }
        if(runOfShow.sessions[n].info.event_info.duration != ''){
            duration = parseInt(runOfShow.sessions[n].info.event_info.duration)*60
            event_time = showtime// this passes it below
            
            display_event_time = localTime(showtime)//converst
            start_time = showtime
            showtime = parseInt(showtime)+duration; //add duration for next 
            //console.log("duration",runOfShow.sessions[n],duration,display_event_time,convertDate(showtime))
                
                
            // console.log("info not undefined",runOfShow.sessions[n],duration,display_event_time,convertDate(showtime))
            }

        list+= '<BR><h4>'
        list += '<span class="session-time">'+display_event_time+' </span>'
//        list += '<br>'
       
    // list+= '<span>'+session_order+" - </span> "
     
            
        list+= session.title+'</h4>'
    
        description = session.info.content.replace(/(<([^>]+)>)/gi, "")
    

      /*
            //DESCRIPTION
      */
      
        //  list+= '<em style="font-style:italic !important">'+description+'</em><br>'




//        list+='<ul>'
        //list+='<li><strong>Invited Speakers</strong></li>'
        
        for (var p = 0; p < runOfShow.sessions[n].profiles.length; p++) { //speakers
            credential = '' 
         //  credential += '|'   
            this_profile = runOfShow.sessions[n].profiles[p]
            info = this_profile.profile.meta
           
            if(info.profile_title != undefined){
                credential +=  '<span>'+info.profile_title.trim()+", "+'</span> '
            }
            //credential += '|'
            if(info.company != undefined){
                credential += '<span>'+info.company.trim()+'</span> '
            }
            if(admin == 1){
     //           console.log('info',this_profile)
                credential+='<a href="/wp-admin/post.php?action=edit&post='+this_profile.object_id+'" target="blank">edit</a>'
                if(info.email != undefined){
                credential +=  '|  <span><a href="mailto:'+info.email.trim()+'">'+info.email.trim()+'</a></span> '
                }else {
                    credential +=  ' | <span style="color:red">No Email</span>'
                }
            }
            
           // credential += '|'
     if(info.twitter != undefined){
        credential += '@'+info.twitter.replace("https://twitter.com/","")
         //          credential +=' <a target="_new" class="twitter" href="'+info.twitter+'"><i class="fa fa-x-twitter social-icon" title="'+this_profile.title+' on Twitter"></i></a> '
               //credential +='<a target="_new" class="twitter" href="'+info.twitter+'">Twitter</a> '
               }

            if(info.linkedin != undefined){
              // credential +=' <a target="_new" class="linkedin" href="'+info.linkedin+'"><i class="fa fa-linkedin social-icon" title="'+this_profile.title+' on LinkedIn"></i></a> '

            //   credential +=' <a target="_new" class="linkedin" href="'+info.linkedin+'">'
             //   credential += info.linkedin
            // credential += ' <i class="fa fa-linkedin social-icon" title="'+this_profile.title+' on linkedin"></i>'
//                credential += 'Linkedin'
                credential +='</a> '

            }
       
               
          //     credential += '|'
    

            list+= '<li>• '
      //  list+= this_profile.object_id+'|'
            list+= '<strong>'
            
            list+= this_profile.title+", "
        //    list+='|'
            list+= '</strong>'
            list+= credential+'</li>'
        }
  //      list+='</ul>'

        session_number++;
    }
    list+='</div>'
  
    $("#ros-list").html(list)

}
function displayRunOfShowMonolith(runOfShow){

   // console.log(runOfShow)
   currentROS = runOfShow //"creates memory object;

    var show = '<h2>'+runOfShow.title+'</h2>'

    var showtime = null
    if(runOfShow.info.event_info.utc_start != undefined){
        showtime = runOfShow.info.event_info.utc_start;
    }
    $("#show").html(show)
    var duration = 0;
    var sessions = '<div id="schedule">'
    var this_profile = ''
    var width_override = ''
    var card_size = 1
    var cell_width = '100%';
    var cols = '';
    var classes = '';
    for (var n = 0; n < runOfShow.sessions.length; n++) { 
        //console.log("session-info",runOfShow.sessions[n].info,showtime)
        if(runOfShow.sessions[n].info != undefined){
            if(runOfShow.sessions[n].info.event_info.duration == undefined){
                runOfShow.sessions[n].info.event_info.duration = 0
            }
           // console.log("duration",runOfShow.sessions[n].info.event_info)
            if(runOfShow.sessions[n].info.event_info.duration != ''){
            duration = parseInt(runOfShow.sessions[n].info.event_info.duration)*60
            event_time = showtime// this passes it below
            classes = runOfShow.sessions[n].classes
            console.log("classes"+n,classes)
            display_event_time = localTime(showtime)//converst
            start_time = showtime
            showtime = parseInt(showtime)+duration; //add duration for next 
            //console.log("duration",runOfShow.sessions[n],duration,display_event_time,convertDate(showtime))
                
                }
            // console.log("info not undefined",runOfShow.sessions[n],duration,display_event_time,convertDate(showtime))
            }
    //        console.log(runOfShow.sessions[n],duration,display_event_time,convertDate(showtime))
            sessions += '<div class="row session '+classes+'">'
          /*  
            sessions += '<div class="col-sm-2 col-md-1">'
            sessions += '<h3 class="ros"><span class="spacer"></span><span class="session-time">'+display_event_time+' </span></h3>'
          //  sessions += '<div class="card-mode">'
        //  sessions += '<img src="/wp-content/uploads/2021/09/BusinessSummitBrandCard.png"+ alt="'+runOfShow.title+'">'
     
        sessions += '<ul class="session-times card-info">'
        sessions += '<li class="event-date">14 September 2021</li>'
 
        sessions += '<li><span>PDT</span><BR>'+convertDateTime(start_time,-7) +'</li>'
        sessions += '<li><span>EDT</span><BR>'+convertDateTime(start_time,-4) +'</li>'
        sessions += '<li><span>UTC</span><BR>'+convertDateTime(start_time,0) +'</li>'
        sessions += '<li><span>BST</span><BR>'+convertDateTime(start_time,1) +'</li>'
        sessions += '<li><span>CEST</span><BR>'+convertDateTime(start_time,2) +'</li>'
        sessions += '<li><span>CST</span><BR>'+convertDateTime(start_time,8) +'</li>'
        sessions+= '</ul>'
        
        sessions+= '</div>'
      */
        sessions+= '<div class="col-sm-3 col-md-2">'
        
        sessions += '<h3 class="session-title ">'+runOfShow.sessions[n].title+'</h3>'
    //   

    sessions+= '</div>'
        sessions +='<div class="col-sm-6 col-md-10">'//session

            sessions += '<div class="row" class="speaker-list">'
            width_override = ''
            
            if(runOfShow.sessions[n].profiles.length == 5){
                width_override = 'fifth'
                card_size = 1
                cols='fifth'
            } else if(runOfShow.sessions[n].profiles.length == 1){
                width_override = 'presentation'
                card_size = 2
                cols='col-sm-6 col-md-3'

            } else if(runOfShow.sessions[n].profiles.length == 2){
                width_override = 'pair'
                card_size = 2
                cols='col-sm-6 col-md-3'

            } else {
                width_override = ''
                card_size = 1
                cols='col-sm-6 col-md-3'

            }
            cols='col'
            if(runOfShow.sessions[n].profiles.length > 3){
                width_override = 'pair'
                card_size = 2
              //  cols='col-xs-6 col-sm-6 col-md-4 col-lg-3'

            }


        

cell_width = 100/runOfShow.sessions[n].profiles.length+'%';

        for (var p = 0; p < runOfShow.sessions[n].profiles.length; p++) { //speakers
            
            this_profile = runOfShow.sessions[n].profiles[p]
               
                    sessions += '<div  class="profile-card '+cols+' '+ this_profile.classes +'">'

               // console.log("THIS PROFILE",this_profile)
                if(this_profile.profile != undefined){
                    sessions += getProfileThumbnail(this_profile,'thumbnail');
                 /*                   if(card_size == 1){
                      
                    } else {
                        
                        sessions += getProfileThumbnail(this_profile,'medium');

                    }*/
                    if((width_override == 'presentation') || (width_override == 'pair')){
                        sessions += '</div><div class="col">'
                    }
                    sessions += '<span class="profile-info">'
                
                    sessions += '<span class="profile-name ' +this_profile.slug+'">'+this_profile.title+'</span>'
                    
                   
                sessions += getProfileCard(this_profile,event_time);
                
                if(width_override == 'presentation'){
               //    sessions += '</div><div class="col-sm-12 col-md-8 talk-blurb">'
                /*
               
                     if(this_profile.profile.info.talk_description != undefined){
                    sessions += '<span class="blurb">'+this_profile.profile.info.talk_description+'</span>'
                }*/
            }
                sessions += '</span>'
                
                } else {
                    if(getUrlParameter('hold') == 'show'){
                        sessions += '<span class="profile-name">'+this_profile.title+'</span>'
                   }
                   
                }

                
                



                sessions += '</div>'


           }
           
           sessions += '</div>'
           sessions += '</div>'


           

          
        sessions += '</div>'
    }
    sessions +='</div>'
    $("#ros-table").html(sessions)

   
    if(getUrlParameter('collapse') != 'all'){
       
    //    activateAccordion("#ros-accordion")
    }
    if(getUrlParameter('cards') == 'show'){
    //    $('#ros-accordion').addClass('cards')

   }

}

function displayRunOfShowTable(runOfShow){
   
    console.log("displayROSTable",runOfShow)
      currentROS = runOfShow //"creates memory object;
    var first = 0;
    var ini
    var show = '<h2>'+runOfShow.title+'</h2>'
    var now = new Date()

    var showtime = null
   // console.log("ROSTEST",runOfShow.info)
    if(runOfShow.info.event_info != undefined){
        showtime = runOfShow.info.event_info.utc_start;
    }
    var duration = 0;
    var tense = "future";
    var seconds =  Math.floor(Date.now() / 1000)
    if(seconds>showtime){
        tense = "past"
    }
    //console.log("event time",tense, showtime);
    //console.log("TENSE", tense)
    $("#show").html(show)

    var duration = 0;
    var sessions = '<div id="schedule" class="'+event_class+'">'
    var this_profile = ''
    var width_override = ''
    var card_size = 1
    var cell_width = '100%';
    var cols = '';
    var suppress_speaker_list = 0 // session level
    var suppress_event_speaker_list = 0 //event level

    var suppress_unconfimred_speakers = 0 //session level
    var suppress_event_unconfimred_speakers = 1 // event level
    var section_class = ''
    var classes = ''
    var section_strip_from_label = ''
    if("ROSTEST",runOfShow.info.meta.section_strip_from_label != undefined){
        section_strip_from_label = runOfShow.info.meta.section_strip_from_label
    }
    
    var show_speakers = getUrlParameter('show_speakers')
    var show_unconfirmed_speakers = getUrlParameter('show_unconfirmed_speakers')
    var session_ids = []
    var session_title = ''
    for (var n = 0; n < runOfShow.sessions.length; n++) { 
        session_title = runOfShow.sessions[n].title.replace(section_strip_from_label,'').trim()
       
       //
 //console.log("Suppress list",suppress_event_speaker_list)
      
         session_ids.push({"id":runOfShow.sessions[n].object_id,"title":session_title,
         //"data":runOfShow.sessions[n]
        })
        //console.log("session-info",runOfShow.sessions[n].info,showtime)
        if(runOfShow.sessions[n].info != undefined){

            if(tense == 'past' && runOfShow.sessions[n].info.meta.embed_video_url == undefined){
                //console.log("skip")
               // continue;

            }

        //    console.log("Suppress it",runOfShow.sessions[n].title,suppress_event_speaker_list)
             suppress_event_speaker_list = runOfShow.info.meta.suppress_speaker_list
            section_class = ''
             if(runOfShow.sessions[n].info.meta.section_class != undefined){
                section_class = ''            
            }
          //  console.log("duration",runOfShow.sessions[n].info)
            if(runOfShow.sessions[n].info.event_info === undefined){
                runOfShow.sessions[n].info.event_info = {}
            
                runOfShow.sessions[n].info.event_info.duration = 0
            }
            if(runOfShow.sessions[n].info.event_info.duration != ''){
                duration = parseInt(runOfShow.sessions[n].info.event_info.duration)*60
                event_time = showtime// this passes it below
                
                display_event_time = localTime(showtime)//converst
                start_time = showtime
                showtime = parseInt(showtime)+duration; //add duration for next 
                //console.log("duration",runOfShow.sessions[n],duration,display_event_time,convertDate(showtime))
                    
            }
                // console.log("info not undefined",runOfShow.sessions[n],duration,display_event_time,convertDate(showtime))
        
              //console.log(runOfShow.sessions[n],duration,display_event_time,convertDate(showtime))
   
            sessions += '<div id="'+runOfShow.sessions[n].info.slug+'"  class="row session '+classes+'">'
            
            sessions += '<div class="col-sm-3 col-md-2">'
            if(tense == 'future'){
            sessions += '<h3 class="ros"><span class="spacer"></span><span class="session-time">'
            if(display_event_time === undefined){
            }
                sessions += display_event_time
           
            sessions += '</span></h3>'
            } else {
              var embed_video_url = embed_video_url = addYouTubeParameters(runOfShow.sessions[n].info.meta.embed_video_url)
                if(embed_video_url != undefined){
                            //              console.log(embed_video_url)
                if(runOfShow.sessions[n].info != undefined){
                    embed_video_url  = embed_video_url.replace(/(\?.+)?$/, function(match) {
                        return match ? match + '&autoplay=1&rel=0' : '?autoplay=1&rel=0';
                    });
                console.log("event"+n,runOfShow.sessions[n].info.featured_media)
                sessions += '<a href="#'+runOfShow.sessions[n].info.slug+'" class="watch video-button" onclick="playSessionVideo(\''+embed_video_url+'\',\''+runOfShow.sessions[n]+'\',\'\''+')" class="watch"><i title="WATCH" class="fa fa-youtube"></i><br> Watch</a>'
                    }
                }
            }
          //  sessions += '<div class="card-mode">'
        //  sessions += '<img src="/wp-content/uploads/2021/09/BusinessSummitBrandCard.png"+ alt="'+runOfShow.title+'">'
        /*
        sessions += '<ul class="session-times card-info">'
        sessions += '<li class="event-date">14 September 2021</li>'
 
        sessions += '<li><span>PDT</span><BR>'+convertDateTime(start_time,-7) +'</li>'
        sessions += '<li><span>EDT</span><BR>'+convertDateTime(start_time,-4) +'</li>'
        sessions += '<li><span>UTC</span><BR>'+convertDateTime(start_time,0) +'</li>'
        sessions += '<li><span>BST</span><BR>'+convertDateTime(start_time,1) +'</li>'
        sessions += '<li><span>CEST</span><BR>'+convertDateTime(start_time,2) +'</li>'
        sessions += '<li><span>CST</span><BR>'+convertDateTime(start_time,8) +'</li>'
        sessions+= '</ul>'
        */
        sessions+= '</div>'
      
        sessions+= '<div class="col-sm-9 col-md-10">'
      //  console.log("session_id",runOfShow.sessions[n].object_id)
        if(runOfShow.sessions[n].info != undefined){

        sessions += '<h3 class="session-title ">'+session_title+'</h3>'
      //  sessions += '<h5 class="session-blurb ">'+runOfShow.sessions[n].info.content+'</h3>'
      
            if(runOfShow.sessions[n].info.content != ''){
                sessions += '<div class="session-content ">'+runOfShow.sessions[n].info.content+'</div>'
            }
        }


        //   

        sessions+= '</div>'//time title content
        sessions+= '</div>'//row
        sessions +='<div class="row"><div class="col-12">'//session

        sessions += displaySessionProfiles(runOfShow.sessions[n].object_id)
        
          
        sessions += '</div>'
        }
    }
    sessions +='</div>'
      
    $("#ros-table").html(sessions)
    playSessionVideo(runOfShow.sessions[first].info.meta.embed_video_url,runOfShow.sessions[first],'')
   
    if(getUrlParameter('collapse') != 'all'){
       
    //    activateAccordion("#ros-accordion")
    }
    if(getUrlParameter('cards') == 'show'){
        $('#ros-accordion').addClass('cards')
       
   }
    
   console.log("sesion_ids", session_ids)



}
function setSessionByID(id){
    //console.log("ros",id,currentROS)
    for(var s=0;s<currentROS.sessions.length;s++){
        if(currentROS.sessions[s].object_id == id){

            return currentROS.sessions[s]
        }

    }

   

}


function displaySessionProfiles(id){ // this shows the speaker list
   
    var session = setSessionByID(id)
    if(session != undefined){
    
  

   console.log("session",id,session)


    var suppress_speaker_list = 0 // session level
    var suppress_event_speaker_list = 0 //event level

    var suppress_unconfimred_speakers = 0 //session level
    var suppress_event_unconfimred_speakers = 1 // event level
   
   var sessions = '<div class="row" class="speaker-list">'
            width_override = ''
            if(session.profiles.length == 5){
                width_override = 'fifth'
                card_size = 1
                cols='fifth'
            } else if(session.profiles.length == 1){
                width_override = 'presentation'
                card_size = 2
                cols='col-sm-6 col-md-3'

            } else if(session.profiles.length == 2){
                width_override = 'interview'
                card_size = 2
                cols='col-sm-6 col-md-3'

            } else {
                width_override = ''
                card_size = 1
                cols='col-sm-6 col-md-3'

            }
            cols='col'
            if(session.profiles.length == 3 || session.profiles.length == 4){
                width_override = 'pair'
                card_size = 2
                cols='col-xs-6 col-sm-6 col-md-3'

                
            } else if(session.profiles.length == 5 ){
                cols='col-xs-6 col-sm-6 col-md-4 fifth'
            }
            else if(session.profiles.length > 5 ){

                cols='col col-xs-6 col-sm-6 col-md-4'
            }



            //suppress_speaker_list = 0;
            if(session.info != undefined){

                if(session.info.meta.suppress_speaker_list != undefined){
                    suppress_speaker_list = session.info.meta.suppress_speaker_list;
                    
                }
            }

        cell_width = 100/session.profiles.length+'%';
        
        //        console.log("show speakers",show_speakers)
        if(suppress_event_speaker_list == 0||show_speakers == 1){
            for (var p = 0; p < session.profiles.length; p++) { //speakers
                
                this_profile = session.profiles[p]
             //   console.log('THumb',this_profile.profile,this_profile.profile.thumbnail_url.length)
             

                        sessions += '<div  class="profile-card '+cols+' '+ this_profile.classes +'">'

                // console.log("THIS PROFILE",this_profile)
                    if(this_profile.profile != undefined){
                     //   if(this_profile.profile.thumbnail_url.length != 0 || show_unconfirmed_speakers == 1){} 
                                sessions += getProfileThumbnail(this_profile,'thumbnail');
                            /*                   if(card_size == 1){
                                
                                } else {
                                    
                                    sessions += getProfileThumbnail(this_profile,'medium');

                                }*/
                                if((width_override == 'presentation')){
                                    sessions += '</div><div class="col">'
                                } else if (width_override == 'inteview'){
                                    
                                }
                                sessions += '<span class="profile-info">'
                            
                                sessions += '<span class="profile-name ' +this_profile.slug+'">'+this_profile.title
                                console.log(

                                    "classes",
                                    this_profile.classes
                                )
                                sessions += '<br><span class="'+this_profile.classes+'">'+this_profile.classes+'</span>'
                                sessions +='</span>'
                                
                            
                            sessions += getProfileCard(this_profile);
                        
                
                    if(width_override == 'presentation'){
                   // sessions += '</div><div class="col-sm-12 col-md-8 talk-blurb">'
                    
                //       console.log(this_profile.profile);
                    if(this_profile.profile.meta.talk_description != undefined){
                    //    sessions += '<span class="blurb">'+this_profile.profile.meta.talk_description+'</span>'
                    }
                     }
                    sessions += '</span>'
                
                    } else {
                        if(getUrlParameter('hold') == 'show'){
                            sessions += '<span class="profile-name">'+this_profile.title+'</span>'

                    }
                    
                    }

                    
                    



                    sessions += '</div>'


           }
        }           
           sessions += '</div>'
           sessions += '</div>'
        return sessions;
    }

}

function displaySelectedVideoProfiles(profiles){
    console.log("profiles",profiles);
    var profile_list


    return profile_list;
}












        function getUrlVars()
{
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}
     















function playProfileVideo(a,index){
  
    session = profile_events[a][index]
    console.log("session",session,index,profile_events);
     var event_class = session.event_slug;
     var event = '<h3 class="video-title '+session.event_slug+'" title="'+session.event_title+'">'+session.event_title+'</h3>'
     var header = ''
     
     header = event+'<h4>'+session.session_title+'</h4>'
 
 
     var sponsors = '<div class="'+session.slug+'-sponsors" title="'+session.session_title+' Sponsors"></div>'
 
     var footer = ''//sponsors+displaySessionProfiles(session.session_id);
 
     $("#video-wrap-header").html(header);
 
     $("#video-wrap-footer").html(footer);
 //    console.log(src)
 
 $("#video-player").attr("src",session.session_embed_video_url)

 
 
 }
 
 



 function setROS(slug){//passes wp slug;
            var menu_name = ros_list[slug]//converts it to menu_name;
           console.log("SetROS menu name",slug,ros_list,menu_name,menus[slug])
           
            currentROS = runOfShow(menus[slug])
          console.log("set",currentROS)
        }




































function playSessionVideo(src,session_id,attrs){

    var session = setSessionByID(session_id);
  
    var event_class = currentROS.slug;
    var event = '<div class="'+currentROS.slug+'" title="'+currentROS.title+'">'+currentROS.title+'</div>'
    var header = ''
    
    header = event+'<h4>'+session.title+'</h4>'


    var sponsors = '<div class="'+currentROS.slug+'-sponsors" title="'+currentROS.title+' Sponsors"></div>'

    var footer = sponsors+displaySessionProfiles(session_id);

    $("#video-wrap-header").html(header);

    $("#video-wrap-footer").html(footer);
//    console.log(src)

    $("#video-player").attr("src",src)


}


function getProfileThumbnail(this_profile,size){
   
    var profile_thumbnail = '<div class="profile-thumbnail">'

    if(this_profile.profile.thumbnail_url != undefined){
        var path = this_profile.profile.thumbnail_url[size] 
        if(path != undefined){
        profile_thumbnail +='<img src="'+path+'" alt="'+this_profile.title+'" title="'+this_profile.title+'">'
        }
    }
    profile_thumbnail += '</div>'
    return profile_thumbnail;
}

function displayRunOfShowCards(runOfShow){
   // displayRunOfShowTable(runOfShow)
    displayRunOfShowCards(runOfShow)
    if(getUrlParameter('cards') != 'show'){
       
            activateAccordion("#ros-accordion")
        }
    
   
}
function hastagify(str){
    str.replace(' ',"")
    str.replace(/[^\w\s]/gi, '')
    return '#'+str

}
function stripHTML(html)
{
   let tmp = document.createElement("DIV");
   tmp.innerHTML = html;
   return tmp.textContent || tmp.innerText || "";
}
function getProfileList(profiles,format){


    var profile_list = ''
    var this_profile = ''
    var twitter_handle = ''
    var profile_name = ''
    var profile_title = ''
    var profile_company = ''
    
    //console.log("p",profiles, format)
    for (var p = 0; p < profiles.length; p++) { 
        twitter_handle = ''
        profile_title = ''
        profile_company = ''
        if(profiles[p].profile.meta.twitter != undefined){
            twitter_handle = '@'+profiles[p].profile.meta.twitter.replace("https://twitter.com/","")
        }
        if(profiles[p].profile.meta.company != undefined){
            profile_company = profiles[p].profile.meta.company
        }
        if(profiles[p].profile.meta.profile_title != undefined){
            profile_title = profiles[p].profile.meta.profile_title
        }
        if(format == 'twitter'){
            profile_list +=profiles[p].title+" "
            if(profiles[p].profile.meta.twitter != undefined){
                
                if((p>=1)&& (p == (profiles.length-1))){   
                    profile_list += ' & '
                 } else {
                   
                 }


                profile_list += twitter_handle+' of '+profile_company + ' ';
                }
        } else if(format == 'lastnames') {
            this_profile = profiles[p].title.split(" ")
            profile_list += this_profile[this_profile.length-1]+' ' 
        } else if(format == 'names') {
            if((profiles.length>2) && (p <= (profiles.length-1))){   
                profile_list += ', '
            }

            if((p>=1)&& (p == (profiles.length-1))){   
                profile_list += ' and '
             }
            profile_list += profiles[p].title+" "
    
            
        }else {
            if((profiles.length>2) && (p <= (profiles.length-1))){   
                //profile_list += ', '
            }

            if((p>=1)&& (p == (profiles.length-1))){   
                profile_list += ' and '
             }
            profile_list += profiles[p].title+" - "
            if(profile_title!=''){
                profile_list += " "+profile_title+", "
            }
            if(profile_company!=''){
                profile_list += profile_company+' '
            }
            if(twitter_handle !=''){
              //  profile_list += twitter_handle
            }
            if((p <= (profiles.length-1))){   
              //  profile_list += '; '
             }
             profile_list += '\n'

        }
                
    }
    return profile_list
}
function showThisProfile(this_profile){
    switch(this_profile.cf){
        case "team": return true;
        case "registered": return true;
        case "registered-no-release": return true;
        case "calendar-sent": return true;
        case "calendar-sent-no-release": return true;
        case "confirmed-no-release": return true;
        case "confirmed-no-registration": return true;
        
        case "prerecord": return true;
        case "complete": return true;
        
        
        

        default: return false;
    }

    return false;
}
function displayRunOfShowCards(runOfShow){
    var format = getUrlParameter('format')
    var transparent_cards = getUrlParameter('transcard')
    var card_class = 'card-mode'
    if(card_class != 'trans-card'){
    var show = '<h2>'+runOfShow.title+'</h2>'
    }
   // console.log("ROS",runOfShow)
   var showtime = null
  
   if(runOfShow.info.event_info.utc_start != undefined){
        showtime = runOfShow.info.event_info.utc_start;
    }
  //  console.log("SHOWTIME",showtime)
    $("#show").html(show)
    var duration = 0;
    console.log(format)
    if(format == 'hd'){
        var sessions = '<div id="ros-accordion" class="hd">'
    
    } else{
        var sessions = '<div id="ros-accordion" class="cards">'
    
    }
    var this_profile = ''
    var width_override = ''
    var card_size = 1
    var event_date = convertDate(showtime);
    console.log("event date",event_date)
    var counter=0
    var counter_label
    var session_count = runOfShow.sessions.length-1
    var ids = []
    for (var n = 0; n < runOfShow.sessions.length; n++) { 
        ids.push( runOfShow.sessions[n].object_id)
        if(counter<10){
            counter_label="0"+counter;
        } else {
            counter_label = counter;
        }
        if(runOfShow.sessions[n].info != undefined){
            if(runOfShow.sessions[n].info.event_info != undefined){
                if(runOfShow.sessions[n].info.event_info.duration != ''){
                duration = parseInt(runOfShow.sessions[n].info.event_info.duration)*60
                event_time = showtime// this passes it below
                display_event_time = localTime(showtime)//converst
            //  console.log("SHOWTIME",showtime);
                start_time = showtime
                showtime = parseInt(showtime)+duration; //add duration for next 
                //console.log("duration",runOfShow.sessions[n],duration,display_event_time,convertDate(showtime))
                    
                }
            }
           // console.log("info not undefined",runOfShow.sessions[n],duration,display_event_time,convertDate(showtime))
        }
//        console.log(runOfShow.sessions[n],duration,display_event_time,convertDate(showtime))
      //  console.log("title time",display_event_time,runOfShow.sessions[n].title)
      if(!transparent_cards){ 
            sessions+='<input type="text" value="'+counter_label+'-'+runOfShow.sessions[n].slug+'" size="100"><BR><BR>'
        //    sessions+='<input type="text" value="'+counter_label+' of 21 -'+runOfShow.sessions[n].title+' - WebXR  Production Summit" size="100"><BR><BR>'
        }
        sessions+='<input type="text" value="'+counter_label+'-'+runOfShow.sessions[n].slug+'" size="100"><BR><BR>'
        if(format == 'hd'){
        //   console.log(runOfShow.sessions[n].profiles)
            var profile_twitter = getProfileList(runOfShow.sessions[n].profiles,"twitter")
            var profile_list = getProfileList(runOfShow.sessions[n].profiles,"full")
            var profile_list_names = getProfileList(runOfShow.sessions[n].profiles,"names")
            
            var last_names = getProfileList(runOfShow.sessions[n].profiles,"lastnames")
            var this_title = counter_label+' of '+ session_count +' - ' +runOfShow.sessions[n].title+" - "+runOfShow.title
            var title_with_names = this_title+' with '+profile_list_names.replace(' and ',' & ')
            var title_with_lastnames =this_title+' w/ '+last_names.replace(' and ',', ')
          
          //END SUMMIT
              description = stripHTML(runOfShow.sessions[n].info.content)+'\nThank you to '+profile_list+'\nWatch now '+runOfShow.sessions[n].info.meta.video_url
           //  var  description = stripHTML(runOfShow.sessions[n].info.content)+'\nWith  '+profile_list+'\nThe WebXR Summit Series is presented by Powersimple in association with MetaVRse and XR Women - Sponsored by Futurewei Technologies.'
        
        //    console.log('len',title_with_names.length)
            if(title_with_names.length<=100){
                this_title = title_with_names
            } else if(title_with_lastnames<100){
                this_title = title_with_lastnames
            } else 
            console.log(last_names)
            
//           sessions+='<BR><BR><BR><BR><BR><BR><input type="text" value="'+this_title+'" size="100">'+this_title.length+' | '+title_with_lastnames.length +'<BR>'
  //          sessions+='<textarea cols="100" rows="10">' +description+'</textarea><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR>'

           console.log("ROS",n,runOfShow.sessions[n].info.meta.video_url)
           
           if(runOfShow.sessions[n].info.meta.video_url != undefined){
          // var linkedin_description = 'Thank you to '+profile_list+' for being part of the discussion "'+runOfShow.sessions[n].title+'" at the WebXR Production Summit'+ stripHTML(runOfShow.sessions[n].info.content)+'\nWatch the video on YouTube:'+runOfShow.sessions[n].info.meta.video_url
          var linkedin_description = 'Thank you to '+profile_list+' for being part of the discussion "'+runOfShow.sessions[n].title+'" at the WebXR Production Summit'+ stripHTML(runOfShow.sessions[n].info.content)+'\nWatch the video on YouTube: '+runOfShow.sessions[n].info.meta.video_url
        
            sessions+='<BR><BR><BR>LinkedIn <textarea cols="100" rows="12">' +linkedin_description+'</textarea><BR><BR>'
            var twitter_blurb =  'Thank you '+profile_twitter+' for appearing at the #WebXRProductionSummit hosted by @danieldbryant with @juliesmithso'+ '\nWatch '+runOfShow.sessions[n].title+' '+runOfShow.sessions[n].info.meta.video_url
            sessions+='<input type="text" value="'+twitter_blurb.length+'" size="100"><br><br>'
          sessions+='<textarea cols="100" rows="10">' +twitter_blurb+'</textarea><BR><br><BR><br><BR><br><BR><BR><BR><BR><BR>'
     
       } 
       
    //   var twitter_blurb =  'Thank you to '+profile_twitter+' for being part of the '+runOfShow.sessions[n].info.meta.session_type+' "'+runOfShow.sessions[n].title+'" at the #WebXREducationSummit'+ '\nWatch:'+runOfShow.sessions[n].info.meta.video_url
       



        }




      counter++
      sessions += '<h3 class="ros"><span class="spacer"></span><span class="session-time"> </span> '+runOfShow.sessions[n].title+'</h3>'

      var card_style= runOfShow.info.meta.event_style_class
      if(transparent_cards){
        card_class = 'trans-card'
        card_style = ''
      } 
        sessions += '<div class="'+card_class+' '+card_style+'">'

      //  sessions += '<img src="/wp-content/uploads/2021/09/BusinessSummitBrandCard.png"+ alt="''">'
      sessions += '<div class="show-title">'

      sessions += '<span class="series-logo"></span>'
      sessions += '<h4>'+runOfShow.title+'</h4>'
      sessions += '<h5 class="the-host">Hosted by Daniel Dyboski-Bryant with Julie Smithson</h5>'
      sessions += '<h5 class="event-date">'+event_date+'</h5>'
        sessions += '</div>'
      
      sessions += '<ul class="session-times card-info">'
  
      if(format!='hd'){
     
       sessions += '<li><span>Los Angeles</span>'+convertDateTime(start_time,-7) +'</li>'
        sessions += '<li><span>New York</span>'+convertDateTime(start_time,-4) +'</li>'
        sessions += '<li><span>UTC</span>'+convertDateTime(start_time,0) +'</li>'
        sessions += '<li><span>London</span>'+convertDateTime(start_time,1) +'</li>'
        sessions += '<li><span>Paris</span>'+convertDateTime(start_time,2) +'</li>'
        sessions += '<li><span>Beijing</span>'+convertDateTime(start_time,8) +'</li>'
      } else {
        
      }
      sessions+= '</ul>'
  
        sessions += '<h3 class="card-info">'+runOfShow.sessions[n].title+'</h3>'
     //   

        sessions += '<div id="speaker-list" class="row">'
        width_override = ''
        runOfShow.sessions[n].card_count = runOfShow.sessions[n].profiles.length

        for (var p = 0; p < runOfShow.sessions[n].profiles.length; p++) {
            this_profile = runOfShow.sessions[n].profiles[p]
            var show_this = showThisProfile(this_profile);
            if(!show_this){
             //   console.log("hide",this_profile.title, runOfShow.sessions[n].card_count)
                runOfShow.sessions[n].card_count--
               // console.log("after hide",this_profile.title, runOfShow.sessions[n].card_count)
                continue;
            }
        }
        var confirmed_profile_count = runOfShow.sessions[n].card_count
        console.log(runOfShow.sessions[n].title,confirmed_profile_count)
        
        if(confirmed_profile_count == 5){
            width_override = 'fifth'
            card_size = 1
        } else if(confirmed_profile_count == 1){
            width_override = 'presentation'
            card_size = 2
        } else if(confirmed_profile_count == 2){
            width_override = 'interview'
            card_size = 2
        } else if(confirmed_profile_count == 3){
            width_override = 'three'
            card_size = 2
        } else {
            width_override = ''
            card_size = 1
        }
        if (width_override == 'interview'){
           // sessions += '<div class="col-sm-6 '+ width_override+'"><span class="blurb">'+runOfShow.sessions[n].info.content+'</span></div>'
            }
        for (var p = 0; p < runOfShow.sessions[n].profiles.length; p++) { 
            
            this_profile = runOfShow.sessions[n].profiles[p]
         //   console.log("CF",this_profile.title,this_profile.cf)
            
         
         
         
         var show_this = showThisProfile(this_profile);





            if(!show_this){
                continue;
            }
                sessions += '<div class="col">'
                    sessions += '<div class="profile-card" class="'+ this_profile.classes +'">'
               // console.log("THIS PROFILE",this_profile)
                if(this_profile.profile != undefined){
                    if(card_size == 1){
                        sessions += getProfileThumbnail(this_profile,'thumbnail');
                    } else if ((card_class == 'trans-card') || (format == 'hd')) {
                        sessions += getProfileThumbnail(this_profile,'medium_large');
                    } else {
                        
                        sessions += getProfileThumbnail(this_profile,'medium');

                    }
                    sessions += '<span class="profile-info">'
                
                    sessions += '<span class="profile-name ' +this_profile.slug+'">'+this_profile.title
                                console.log(

                                    "classes",
                                    this_profile.classes
                                )
                                sessions += '<br>'+this_profile.classes
                                sessions +='</span>'
                    
    
                sessions += getProfileCard(this_profile,event_time);
                
                //console.log("wo",width_override)
                    if(width_override == 'presentation'){

                        if(runOfShow.sessions[n].info.content != undefined){

                            sessions += '<span class="blurb">'+runOfShow.sessions[n].info.content+'</span>'
                        }
                    }
                sessions += '</span>'
                
                } else {
                    if(getUrlParameter('hold') == 'show'){
                        sessions += '<span class="profile-name">'+this_profile.title+'</span>'
                   }
                   
                }

                




                sessions += '</div>'

                sessions += '</div>'

           }
         
           sessions += '</div>'

           if(card_class == 'trans-card'){
               if(width_override != 'interview' && width_override!='presentation'){
                    sessions += '<div class="panel-blurb">'+runOfShow.sessions[n].info.content+'</div>'
                }
           }


           sessions += '<div class="card-footer">'
           sessions += '<span class="event-info">'
           if(format!='hd'){
              sessions += '<a class="rsvp-link" href"'+runOfShow.info.meta.tickets_url+'" target="_new">RSVP: '+runOfShow.info.meta.tickets_url+'</a><BR>'
           } else {
                
          
           }
           sessions += '<a class="rsvp-link" href"https://webxr.events/" target="_new">//webxr.events</a> | '
           sessions += '<a class="rsvp-link" href"https://twitter.com/webxrawards" target="_new">@webxrawards</a> | '
           sessions += '<a class="rsvp-link" href"#" target="_new">#webxrsummit</a>'
           if(format == 'hd'){
           sessions += ' | <a class="rsvp-link" href"https://bit.ly/WebXR-Production-Summit" target="_new">//bit.ly/WebXR-Production-Summit</a><br>'
            } 
           sessions += '</span>'
           if(format == 'hd'){
            sessions += '<span class="presenter-info">'
            sessions += 'Presented by Powersimple in association with MetaVRse and XR Women  - Futurewei Technologies Series Sponsor - A Point Cloud Production'
            sessions += '</span>'
           }
           
           sessions += '</div>'
             if(format == 'hd'){
      sessions += '<span class="sponsor-logo futurewei-logo"><a href="https://futurewei.com" target="_new"  title="Futurewei Technologies"><img src="/wp-content/themes/webxrsummits/images/logo/Futurewei-White-shadow.png" alt="Futurewei Technologies Logo"></a>'
         
          sessions += '<span class="sponsor-logo presenters-logo"><a href="#" target="_new"  title="Presenting Partners"><img src="/wp-content/themes/webxrsummits/images/logo/powersimple-metavrse-xrwomen-wide.png" alt="Presenting Partners Logos"></a>'

            //sessions += '<span class="presenting-partners">Presenting</span>'
            //sessions += '<span class="series-sponsor">Series Sponsor</span>'
           }
           sessions += '</span>'
        sessions += '</div>'
    }
    sessions +='</div>'
    $("#sessions").html(sessions)
   

    console.log("IDS",ids)
   
    if(getUrlParameter('collapse') != 'all'){
       
    //    activateAccordion("#ros-accordion")
    }
    if(getUrlParameter('cards') == 'show'){
        $('#ros-accordion').addClass('cards')

   }

}
jQuery(document).ready(function() {

  

});
function activateAccordion(id){
    console.log("triggered")
    jQuery(id).accordion({
        header: "h3",
        collapsible: false,
        autoHeight: true,
        heightStyle:"content",
        navigation: true
    });

}

function displayShow(){

}
function displaySession(){
    
}
function displayProfile(){
    
}
function utcDate(d){
    d= new Date(d);

    return  d.getUTCMonth()+1+' '+ d.getUTCDate() + ' '+ d.getUTCFullYear()
 
}
function utcTime(d,offset){
    d= new Date(d);
    var tail= 'GMT', D= [d.getUTCFullYear(), d.getUTCMonth()+1, d.getUTCDate()],
    T= [d.getUTCHours(), d.getUTCMinutes(), d.getUTCSeconds()];
    if(+T[0]> 12){
        T[0]-= 12;
        tail= ' pm '+tail;
    }
    else tail= ' am '+tail;
    var i= 3;
    while(i){
        --i;
        if(D[i]<10) D[i]= '0'+D[i];
        if(T[i]<10) T[i]= '0'+T[i];
    }
    return D.join('/')+' '+T.join(':')+ tail;
}
function localTime(unix_timestamp){
    
    // Create a new JavaScript Date object based on the timestamp
    // multiplied by 1000 so that the argument is in milliseconds, not seconds.

    var date = new Date(unix_timestamp * 1000);

    var utc_offset_hours = date.getTimezoneOffset()/60
    
    
    // Hours part from the timestamp
    var hours = parseInt(date.getHours())


    // Minutes part from the timestamp
    var minutes = "0" + date.getMinutes();
    // Seconds part from the timestamp
    var seconds = "0" + date.getSeconds();
    
    // Will display time in 10:30:23 format
    return hours + ':' + minutes.substr(-2);
}
function convertDate(unix_timestamp){
    var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"]
    var date = new Date(unix_timestamp * 1000);
    return date.getDate()+" "+months[date.getMonth()]+" "+date.getFullYear()
}
function convertDateTime(unix_timestamp,offset){
    
    // Create a new JavaScript Date object based on the timestamp
    // multiplied by 1000 so that the argument is in milliseconds, not seconds.

    var date = new Date(unix_timestamp * 1000);

    var utc_offset_hours = date.getTimezoneOffset()/60


    
    // Hours part from the timestamp
    var hours = parseInt(date.getHours())
    var hours_adjusted = hours+utc_offset_hours
   
    var utc_adjusted = hours_adjusted+offset
    if(utc_adjusted>=24){
        utc_adjusted = utc_adjusted-24
    }
 

    // Minutes part from the timestamp
    var minutes = "0" + date.getMinutes();
    // Seconds part from the timestamp
    var seconds = "0" + date.getSeconds();
    
    // Will display time in 10:30:23 format
    return parseInt(utc_adjusted) + ':' + minutes.substr(-2);
}

$(".video-button").on('click', function(event){
    console.log("THIS",$(this).data('url'))

});
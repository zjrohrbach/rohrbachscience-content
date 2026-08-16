---
title: "Group Randomizer"
date: 2026-08-15
summary: "A simple group randomizer for the classroom written in `html` and `JavaScript`.  Saves class rosters locally via the [HTML5 Web Storage API](https://developer.mozilla.org/en-US/docs/Web/API/Web_Storage_API)."
tags:
- coding
- teaching
- thinking classrooms
---

In using [Building Thinking Classrooms]({{< ref "publications/btc/" >}}) methods in my class, I randomize groups for every Whiteboard Thinking Task or Lab.  I was using [this Team Picker Wheel](https://pickerwheel.com/tools/random-team-generator/), which is very full-featured, but I thought it would be a fun project to tackle.  

On top of this, the original Picker Wheel that had an update that was causing an annoying browser lag on my weakly-specced school-issued laptop.  My version is much more minimal and is always snappy.

It's just one file. There's no configuration needed.  It stores all the data using the [HTML5 Web Storage API](https://developer.mozilla.org/en-US/docs/Web/API/Web_Storage_API), so there's no server-side infratstructure needed.



[GitHub Link](https://github.com/zjrohrbach/group-randomizer)

[Script Demo](http://tools.rohrbachscience.com/group-randomizer/)
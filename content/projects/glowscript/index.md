---
title: "GlowScript Animations"
date: 2017-04-20
description: "During the 2017 INAAPT Spring Meeting, I listened to a talk about GlowScript as a way to create `VPython` animations online.  I created the following projects to learn the programming language and illustrate a couple physics concepts."
tags:
- coding
- fun
- physics
---


During the 2017 [INAAPT](https://www.inaapt.org) Spring Meeting, I listened to a talk about [GlowScript](https://www.glowscript.org/) as a way to create `VPython` animations online.  I created the following projects just to learn the programming language and illustrate a couple physics concepts.

## Doppler Effect Animation

Following Paul Hewitt, I often describe the Doppler Effect using the analogy of a bug jumping on the surface of a calm pond.  This animation shows this analogy.  You can change the variables `v` and `vs` in the code editor to watch the behavior of the bug.

{{< anim-link src="doppler.png" alt="Doppler Effect Animation" 
    href="https://www.glowscript.org/#/user/zachary.rohrbach/folder/Public/program/DopplerEffect">}}

## Monkey & Hunter Animation

In this classic thought experiment, you are asked to shoot a tranquilizer dart at a monkey in a tree.  The catch is, the monkey will get scared and let go of the branch at the same moment that you fire the dart.  Should you aim at the monkey, above the monkey, or below the monkey in order to hit him?  You can change `v0` in the code to show that no matter how fast your dart travels you still need to aim directly at the monkey.

{{< anim-link src="monkey-hunter.png" alt="Monkey & Hunter Animation" 
    href="https://www.glowscript.org/#/user/zachary.rohrbach/folder/Public/program/MonkeyandHunter">}}


## Bouncing Ball Animation

This animation does not have any real educational value.  This was my first program in `VPython`, and I used it as an experiment to figure out how to code free fall in preparation for the Doppler Effect Animation

{{< anim-link src="bounce.png" alt="Bouncing Ball Animation" 
    href="https://www.glowscript.org/#/user/zachary.rohrbach/folder/Public/program/BouncingBall">}}


## Waves on a String

This was an experiment to see if I could explore a wave as a collection of particles that only interact with neighboring particles instead of as a continuous entity. Each particle in this animation obeys Hooke's law based upon the relative displacement of itself relative to its left and right neighbor.  It works beautifully until it bounces off the barrier.  At that point, there appears to be some extra energy added to the system.  This is a bug that I have not yet been able to fix.

{{< anim-link src="waves.png" alt="Waves on a String Animation" 
    href="https://www.glowscript.org/#/user/zachary.rohrbach/folder/Public/program/WavesOnAString">}}
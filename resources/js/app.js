import "./bootstrap";

import Alpine from "alpinejs";

import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
import * as THREE from "three";

gsap.registerPlugin(ScrollTrigger);

window.Alpine = Alpine;
window.gsap = gsap;
window.ScrollTrigger = ScrollTrigger;
window.THREE = THREE;

Alpine.start();

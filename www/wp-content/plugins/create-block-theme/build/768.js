"use strict";(globalThis.webpackChunkcreate_block_theme=globalThis.webpackChunkcreate_block_theme||[]).push([[768],{3768:(t,s,e)=>{e.r(s),e.d(s,{SVG:()=>i});var n=e(6770),r=e(2592);class i extends r.x{constructor(t,s){const{p:e}=super(t,s);this.version=e.uint16,this.offsetToSVGDocumentList=e.Offset32,e.currentPosition=this.tableStart+this.offsetToSVGDocumentList,this.documentList=new o(e)}}class o extends n.j{constructor(t){super(t),this.numEntries=t.uint16,this.documentRecords=[...new Array(this.numEntries)].map((s=>new c(t)))}getDocument(t){let s=this.documentRecords[t];if(!s)return"";let e=this.start+s.svgDocOffset;return this.parser.currentPosition=e,this.parser.readBytes(s.svgDocLength)}getDocumentForGlyph(t){let s=this.documentRecords.findIndex((s=>s.startGlyphID<=t&&t<=s.endGlyphID));return-1===s?"":this.getDocument(s)}}class c{constructor(t){this.startGlyphID=t.uint16,this.endGlyphID=t.uint16,this.svgDocOffset=t.Offset32,this.svgDocLength=t.uint32}}}}]);
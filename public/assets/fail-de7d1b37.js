import{f as u,r as i,d,e as f,p as o,w as s,u as n,A as _,P as m,an as y}from"./vendor-9f9c92ad.js";import{r as a,d as x}from"./index-4b363c67.js";const v={class:"layouts flex flex-center layouts-empty"},k=u({__name:"fail",setup(C){const r=i("404，小伙伴你迷路了哦"),t=a.currentRoute.value.query;return t.code&&(r.value=`[${t.code}]${t.msg}`),(E,e)=>{const c=m,l=y;return d(),f("main",v,[o(l,{description:n(r)},{default:s(()=>[o(c,{type:"primary",onClick:e[0]||(e[0]=p=>n(a).go(-1))},{default:s(()=>[_("上一页")]),_:1}),o(c,{type:"default",onClick:e[1]||(e[1]=p=>n(a).push("/"))},{default:s(()=>[_("返回首页")]),_:1})]),_:1},8,["description"])])}}});const g=x(k,[["__scopeId","data-v-ce7c89ba"]]);export{g as default};
---
title: "{{ replace .Name "-" " " | title }}"
// subtitle: ""
date: {{ dateFormat "2006-01-02" .Date }}
// summary: ""
// draft: true
tags:
{{- range $.Site.Taxonomies.tags }}
- {{ .Page.Title -}}
{{ end }}
---

Begin Text

<!--more-->
<b></b><div class="kinzi-print">
    <h1>Kinzi Print</h1>
    <hr />
    JQuery Printing Plugin, Print specific HTML element with Header and Footer on every page
    <hr />
    <a href="http://kinziprint.com/" target="_blank">Try the demo</a>
    <hr />
    <h2>Features</h2>
    <ul>
        <li>Print specific DOM element</li>
        <li>Preserve page CSS/styling </li>
        <li>Preserve form entries</li>
        <li>Print Header and Footer on <b>every</b> page</li>
    </ul>
    <hr />
    <h2>Usage</h2>
    <pre>
          $('selector').kinziPrint();
    </pre>
    <hr />
    <h2>Options</h2>
    <p>
        <h3>debug (<i>boolean</i>)</h3>
    <p>
        Debug leaves the iframe visible on the page after <i>kinziPrint</i> runs, allowing you to inspect the markup and CSS.
    </p>
    <h3>importCSS (<i>boolean</i>)</h3>
    <p>
        Copy CSS &lt;link&gt; tags to the <i>kinziPrint</i> iframe. True by default.
    </p>
    <h3>importStyle (<i>boolean</i>)</h3>
    <p>
        Copy CSS &lt;style&gt; tags to the <i>kinziPrint</i> iframe. False by default.
    </p>
    <h3>printContainer (<i>boolean</i>)</h3>
    <p>
        Includes the markup of the selected container, not just its contents. True by default.
    </p>
    <h3>loadCSS (<i>string or array of strings</i>)</h3>
    <p>
        Provide a URL(s) for an additional stylesheet to the <i>kinziPrint</i> iframe. Empty string (off) by default.
    </p>
    <h3>printDelay (<i>number</i>)</h3>
    <p>
        The amount of time to wait before calling print() in the <i>kinziPrint</i> iframe,  Defaults to 500 milliseconds.
    </p>
    <h3>header and footer (<i>string</i>)</h3>
    <p>
        <pre>
                $('selector').kinziPrint({
                    header: $('.print-header-content').html(),
                    footer: $('.print-footer-content').html()
                });
            </pre>
    </p>
    </p>
</div>
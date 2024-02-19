<div class="col-md-12">
    <div class="akismet-box">
        <h2>Activate Akismet</h2>
        <p>Enter your API key to activate Akismet.</p>
        <form method="post" action="management.php">
            <input type="hidden" name="action" value="activate" />
            <input type="text" name="key" placeholder="API Key" />
            <input type="submit" value="Activate" />
        </form>
    </div>
    <br/>
    <div class="akismet-box">
        <h2>Test Akismet</h2>
        <p>Enter some text to test Akismet.</p>
        <form method="post" action="management.php">
            <input type="hidden" name="action" value="test" />
            <textarea name="text" placeholder="Text"></textarea>
            <input type="submit" value="Test" />
        </form>
    </div>
</div>
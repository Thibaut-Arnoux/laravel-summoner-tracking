const core = require('@actions/core');
const http = require('@actions/http-client');
const auth = require('@actions/http-client/lib/auth');

async function getToken(username, password, version) {
    const httpClient = new http.HttpClient('docker-hub-delete-tags');
    const baseUrl = `https://hub.docker.com/${version}`;

    const jsonObj = await httpClient.postJson(
        `${baseUrl}/users/login`,
        {
            username,
            password
        }
    );

    return jsonObj.result.token;
}

async function deleteTag(username, repository, tag, token, version) {
    const accessTokenHandler = new auth.BearerCredentialHandler(token);
    const httpClient = new http.HttpClient(
        'docker-hub-delete-tags',
        [accessTokenHandler],
    );
    const baseUrl = `https://hub.docker.com/${version}`;

    const result = await httpClient.del(`${baseUrl}/repositories/${username}/${repository}/tags/${tag}`);

    let body = await result.readBody();
    core.notice(body);
    core.notice(result.message.statusCode);
    core.notice(result.message.statusMessage);

    if (result.message.statusCode !== 204) {
        throw new Error(`Failed to delete tag : ${tag}`);
    }
}

async function run() {
    // extract inputs
    const username = core.getInput('username', { required: true });
    const password = core.getInput('password', { required: true });
    const repository = core.getInput('repository', { required: true });
    const tag = core.getInput('tag', { required: true });
    const version = core.getInput('version', { required: true });

    const token = await getToken(username, password, version);
    await deleteTag(username, repository, tag, token, version);
}

run();